<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.pages.users.index', [
            'title' => 'Kelola Pengguna',
            'users' => $users,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'phone_number' => ['required', 'string', 'unique:users,phone_number,' . $user->id],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:admin,customer'],
        ]);

        $user->update($request->only('name', 'phone_number', 'email', 'role'));

        return back()->with('success', 'Data pengguna berhasil diperbarui.');
    }
}
