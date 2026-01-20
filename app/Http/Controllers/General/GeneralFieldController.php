<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\PlayTime;
use App\Models\Rent;
use App\Models\RentDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;

class GeneralFieldController extends Controller
{

    public function index()
    {
        $search = request('search');

        $fields = Field::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->paginate(6)
            ->withQueryString(); // Keeps search term when paginating

        return view('general.pages.field.index', [
            'title' => 'Sewa Lapangan',
            'fields' => $fields,
        ]);
    }


    public function show(Field $field, Request $request)
    {
        $selectedDate = $request->query('date', null);

        if ($selectedDate && Carbon::parse($selectedDate)->lt(now()->startOfDay())) {
            return back()->with('error', 'Tanggal sewa minimal mulai besok.');
        }


        // Load playTimes with rentDetails only when date is selected
        if ($selectedDate) {
            $field->load(['playTimes.rentDetails' => function ($query) use ($selectedDate) {
                $query->where('date', $selectedDate)
                    ->whereHas('rent', function ($q) {
                        $q->where('status', 'paid'); // Only consider paid rents as booked
                    });
            }]);
        } else {
            $field->load('playTimes');
        }


        return view('general.pages.field.show', [
            'title' => 'Sewa Lapangan - ' . $field->name,
            'field' => $field,
            'selectedDate' => $selectedDate,
        ]);
    }
}
