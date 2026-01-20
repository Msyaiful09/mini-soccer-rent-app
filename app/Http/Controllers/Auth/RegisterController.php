<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register.index', [
            'title' => 'Daftar',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'phone_number' => ['required', 'unique:users,phone_number'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ]);

        User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer',
        ]);

        return redirect()->route('login')->with('success', 'Akun anda berhasil dibuat! silahkan masuk');
    }
}
