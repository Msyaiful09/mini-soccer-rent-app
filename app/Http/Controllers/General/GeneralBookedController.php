<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use App\Models\RentDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GeneralBookedController extends Controller
{
    public function index()
    {
        $rents = Rent::with(['field', 'rentDetails'])
    ->where('status', 'paid')
    ->whereHas('rentDetails', function ($query) {
        $query->whereDate('date', '>=', Carbon::today());
    })
    ->with(['rentDetails' => function ($query) {
        $query->whereDate('date', '>=', Carbon::today())
              ->orderBy('date', 'asc');
    }])
    ->orderBy(
        RentDetail::select('date')
            ->whereColumn('rent_id', 'rents.id')
            ->orderBy('date', 'asc')
            ->limit(1)
    )
    ->paginate(10);

        return view('general.pages.booked.index', [
            'title' => 'Lapangan Yang Sudah Disewa',
            'rents' => $rents,
        ]);
    }
}
