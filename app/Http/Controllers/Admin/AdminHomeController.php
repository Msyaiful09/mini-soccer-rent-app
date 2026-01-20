<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\PlayTime;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        $totalFields = Field::count();
        $totalPlayTimes = PlayTime::count();

        $totalRents = Rent::count();
        $totalRevenue = Rent::where('status', 'paid')->sum('total_price');
        $pendingRents = Rent::where('status', 'pending')->count();

        return view('admin.pages.home.index', [
            'title' => 'Dashboard Admin',
            'totalUsers' => $totalUsers,
            'totalCustomers' => $totalCustomers,
            'totalAdmins' => $totalAdmins,
            'totalFields' => $totalFields,
            'totalPlayTimes' => $totalPlayTimes,
            'totalRents' => $totalRents,
            'totalRevenue' => $totalRevenue,
            'pendingRents' => $pendingRents,
        ]);
    }
}
