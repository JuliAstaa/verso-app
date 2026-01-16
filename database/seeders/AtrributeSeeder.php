<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AtrributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. SEED SIZES (Ukuran)
        $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'All Size'];
        
        foreach ($sizes as $size) {
            Size::firstOrCreate(['name' => $size]);
        }

        // 2. SEED COLORS (Warna + Hex Code)
        // Hex code berguna kalau nanti mau nampilin bunderan warna di frontend
        $colors = [
            ['name' => 'Hitam',     'hex_code' => '#000000'],
            ['name' => 'Putih',     'hex_code' => '#FFFFFF'],
            ['name' => 'Merah',     'hex_code' => '#FF0000'],
            ['name' => 'Biru Navy', 'hex_code' => '#000080'],
            ['name' => 'Abu-abu',   'hex_code' => '#808080'],
            ['name' => 'Hijau Army','hex_code' => '#4B5320'],
            ['name' => 'Cream',     'hex_code' => '#FFFDD0'],
            ['name' => 'Kuning',    'hex_code' => '#FFFF00'],
        ];

        foreach ($colors as $color) {
            Color::firstOrCreate(
                ['name' => $color['name']], // Cek biar gak duplikat
                ['hex_code' => $color['hex_code']]
            );
        }
    }
}
