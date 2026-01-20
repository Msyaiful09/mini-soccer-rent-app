<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create specific admin
        User::create([
            'name' => 'Super Admin',
            'phone_number' => '081234567890',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create specific customer
        User::create([
            'name' => 'Regular Customer',
            'phone_number' => '081234567891',
            'email' => 'customer@example.com',
            'password' => Hash::make('customer123'),
            'role' => 'customer',
        ]);

        // Generate random admins
        User::factory()->count(3)->state(['role' => 'admin'])->create();

        // Generate random customers
        User::factory()->count(10)->state(['role' => 'customer'])->create();
    }
}
