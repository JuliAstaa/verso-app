<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Panggil Faker (Setting Indonesia biar namanya lokal)
        $faker = Faker::create('id_ID');

        // ================================
        // 1. AKUN UTAMA (JANGAN DIHAPUS)
        // ================================
        
        // Admin Ganteng
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@toko.com',
            'username' => 'admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
        $admin->profile()->create(['phone' => '081234567890', 'gender' => 'male']);

        // Customer Contoh (Budi)
        $customer = User::create([
            'name' => 'Budi Pembeli',
            'email' => 'budi@gmail.com',
            'username' => 'budi123',
            'password' => Hash::make('password'),
            'role' => 'customer',
            'email_verified_at' => now(),
        ]);
        $customer->profile()->create(['phone' => '08987654321', 'gender' => 'male']);

        // ================================
        // 2. GENERATE 500 DUMMY CUSTOMERS
        // ================================
        
        // $this->command->info('Sedang generate 500 user... sabar ya Wok!');

        // for ($i = 0; $i < 500; $i++) {
            
        //     // Logic Random Status
        //     // 80% Kemungkinan Verified
        //     $emailVerifiedAt = $faker->boolean(80) ? now() : null;
            
        //     // 10% Kemungkinan Banned (Soft Delete)
        //     $deletedAt = $faker->boolean(10) ? now() : null;

        //     // Bikin User
        //     $user = User::create([
        //         'name' => $faker->name,
        //         'email' => $faker->unique()->safeEmail, // Pake unique biar gak error duplicate
        //         'username' => $faker->unique()->userName,
        //         'password' => Hash::make('password'), // Semua password sama biar gampang tes
        //         'role' => 'customer',
        //         'email_verified_at' => $emailVerifiedAt,
        //         'deleted_at' => $deletedAt, // Ini kolom ajaib soft delete
        //     ]);

        //     // Bikin Profile User Tersebut
        //     $user->profile()->create([
        //         'phone' => $faker->phoneNumber,
        //         'gender' => $faker->randomElement(['male', 'female']),
        //         'birth_date' => $faker->date('Y-m-d', '2005-01-01'), // Random umur
        //     ]);
        // }
    }
}