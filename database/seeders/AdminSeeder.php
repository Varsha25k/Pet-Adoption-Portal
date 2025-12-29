<?php
// database/seeders/AdminSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@petadopt.com',
            'phone' => '03001234567',
            'address' => 'Karachi, Pakistan',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);
    }
}