<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bikin Akun ADMIN
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@toko.com', // <--- Email Login
            'username' => 'admin',
            'password' => Hash::make('password'), // <--- Password: password
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Bikin Profile Admin (Penting biar gak error null)
        $admin->profile()->create([
            'phone' => '081234567890',
            'gender' => 'male',
        ]);

        // 2. Bikin Akun CUSTOMER (Buat tes nanti aja)
        $customer = User::create([
            'name' => 'Budi Pembeli',
            'email' => 'budi@gmail.com',
            'username' => 'budi123',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);
        
        $customer->profile()->create([
            'phone' => '08987654321',
            'gender' => 'male',
        ]);
    }
}
