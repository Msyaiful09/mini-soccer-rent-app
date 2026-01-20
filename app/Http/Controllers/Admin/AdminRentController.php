<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rent;
use Illuminate\Http\Request;

class AdminRentController extends Controller
{
    public function index()
    {
        $rents = Rent::with(['user', 'field', 'rentDetails.playTime'])->latest()->get();

        return view('admin.pages.rent.index', [
            'title' => 'Data Sewa',
            'rents' => $rents,
        ]);
    }
}
