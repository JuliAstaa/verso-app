<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class SizeSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Size Standar Internasional (Huruf)
        $standardSizes = [
            ['code' => 'XS',  'name' => 'Extra Small'],
            ['code' => 'S',   'name' => 'Small'],
            ['code' => 'M',   'name' => 'Medium'],
            ['code' => 'L',   'name' => 'Large'],
            ['code' => 'XL',  'name' => 'Extra Large'],
            ['code' => 'XXL', 'name' => 'Double Extra Large'],
            ['code' => '3XL', 'name' => 'Triple Extra Large'],
            ['code' => 'ALL', 'name' => 'All Size'],
        ];

        foreach ($standardSizes as $size) {
            Size::create($size);
        }

        // 2. Size Angka (Misal untuk Celana: 27 - 40)
        // Kita loop biar ga capek ngetik satu-satu
        for ($i = 27; $i <= 40; $i++) {
            Size::create([
                'code' => (string) $i,      // Jadinya "28", "29"
                'name' => "Size $i",        // Jadinya "Size 28"
                // 'created_at' => now(),   // Optional kalau mau timestamps rapi
            ]);
        }
        
        // 3. Size Sepatu (Misal: 38 - 45) - Optional kalau jualan sepatu
        for ($i = 38; $i <= 45; $i++) {
             // Kita kasih prefix EU biar beda sama size celana
            Size::create([
                'code' => "EU $i", 
                'name' => "Shoe Size $i",
            ]);
        }
    }
}
