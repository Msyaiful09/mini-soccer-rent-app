<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\PlayTime;
use App\Models\Rent;
use App\Models\RentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;

class GeneralRentController extends Controller
{
    public function index()
    {
        $rents = Rent::where('user_id', auth()->id())
            ->with('field')
            ->latest()
            ->paginate(5); // Change 5 to how many you want per page

        return view('general.pages.rent.index', [
            'title' => 'Sewa Saya',
            'rents' => $rents,
        ]);
    }


    public function show(Rent $rent)
    {
        return view('general.pages.rent.show', [
            'title' => 'Pembayaran Sewa - ' . $rent->rent_receipt,
            'rent' => $rent,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => ['required', 'date', 'after_or_equal:today'],
            'field_id' => ['required', 'exists:fields,id'],
            'play_time_ids' => ['required', 'array', 'min:1'],
            'play_time_ids.*' => ['exists:play_times,id'],
            'rent_type' => ['required', 'in:single,monthly'],
        ]);

        $date = $request->date;
        $fieldId = $request->field_id;
        $playTimeIds = $request->play_time_ids;
        $rentType = $request->rent_type;

        $validPlayTimes = PlayTime::whereIn('id', $playTimeIds)
            ->where('field_id', $fieldId)
            ->get();

        if (count($validPlayTimes) != count($playTimeIds)) {
            return back()->with('error', 'Terdapat play time yang tidak valid.');
        }

        // Check for conflicts only on selected date
        $alreadyBooked = RentDetail::whereIn('play_time_id', $playTimeIds)
            ->where('date', $date)
            ->whereHas('rent', function ($query) {
                $query->where('status', 'paid');
            })
            ->exists();

        if ($alreadyBooked) {
            return back()->with('error', 'Beberapa waktu yang dipilih sudah dibooking.');
        }

        DB::beginTransaction();

        try {
            $totalPrice = $validPlayTimes->sum('price');
            $rentReceipt = 'RENT-' . strtoupper(Str::random(8));

            // Midtrans Config
            Config::$serverKey = config('midtrans.server_key');
            Config::$clientKey = config('midtrans.client_key');
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Midtrans Item Details
            $itemDetails = [];
            foreach ($validPlayTimes as $playTime) {
                $itemDetails[] = [
                    'id' => $playTime->id,
                    'price' => (int) $playTime->price,
                    'quantity' => $rentType === 'monthly' ? 4 : 1,
                    'name' => "Sewa {$playTime->start_time} - {$playTime->end_time}" . ($rentType === 'monthly' ? " (Bulanan)" : ""),
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $rentReceipt,
                    'gross_amount' => (int) ($totalPrice * ($rentType === 'monthly' ? 4 : 1)),
                ],
                'item_details' => $itemDetails,
                'customer_details' => [
                    'first_name' => auth()->user()->name,
                    'email' => auth()->user()->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);

            // Create Rent Record
            $rent = Rent::create([
                'rent_receipt' => $rentReceipt,
                'user_id' => auth()->id(),
                'field_id' => $fieldId,
                'total_price' => $totalPrice * ($rentType === 'monthly' ? 4 : 1),
                'rent_type' => $rentType,
                'snap_token' => $snapToken,
                'midtrans_id' => 'MIDTRANS-' . strtoupper(Str::random(10)),
                'status' => 'pending',
            ]);

            if ($rentType === 'single') {
                foreach ($playTimeIds as $playTimeId) {
                    RentDetail::create([
                        'rent_id' => $rent->id,
                        'play_time_id' => $playTimeId,
                        'date' => $date,
                    ]);
                }
            } elseif ($rentType === 'monthly') {
                // Repeat same schedule weekly for 4 weeks
                for ($i = 0; $i < 4; $i++) {
                    $currentDate = Carbon::parse($date)->addWeeks($i);
                    foreach ($playTimeIds as $playTimeId) {
                        RentDetail::create([
                            'rent_id' => $rent->id,
                            'play_time_id' => $playTimeId,
                            'date' => $currentDate->format('Y-m-d'),
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('rent.show', $rent->rent_receipt)
                ->with('success', 'Berhasil merental lapangan, silakan lanjutkan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memproses sewa: ' . $e->getMessage());
        }
    }


    public function paymentStatus(Rent $rent)
    {
        // Midtrans Config
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');

        try {
            $status = \Midtrans\Transaction::status($rent->rent_receipt);

            $transactionStatus = $status->transaction_status ?? null;

            // Mapping status Midtrans ke lokal
            $statusMap = [
                'settlement' => 'paid',
                'capture' => 'paid',
                'pending' => 'pending',
                'expire' => 'canceled',
                'cancel' => 'canceled',
                'deny' => 'canceled',
            ];

            $localStatus = $statusMap[$transactionStatus] ?? 'pending';

            if ($rent->status !== $localStatus) {
                $rent->status = $localStatus;
                $rent->save();
            }

            return view('general.pages.rent.payment-status', [
                'title' => 'Status Pembayaran - ' . $rent->rent_receipt,
                'rent' => $rent,
                'message' => 'Status pembayaran saat ini: ' . $localStatus,
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mendapatkan status pembayaran: ' . $e->getMessage());
        }
    }

    public function invoiceView(Rent $rent)
    {
        if ($rent->user_id !== auth()->id()) {
            abort(403);
        }

        return view('general.pages.rent.invoice', [
            'title' => 'Invoice - ' . $rent->rent_receipt,
            'rent' => $rent,
        ]);
    }

    public function cancel(Rent $rent)
    {
        if ($rent->user_id !== auth()->id()) {
            abort(403);
        }

        if ($rent->status !== 'pending') {
            return back()->with('error', 'Pesanan tidak dapat dibatalkan.');
        }

        $rent->status = 'canceled';
        $rent->save();

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }
}
