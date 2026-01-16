<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Color; // 👈 Pastikan Model Color sudah ada
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    public function run()
    {
        $colors = [
            ['name' => 'Midnight Black', 'hex_code' => '#101010'],
            ['name' => 'Snow White',     'hex_code' => '#FFFAFA'],
            ['name' => 'Charcoal Grey',  'hex_code' => '#36454F'],
            ['name' => 'Navy Blue',      'hex_code' => '#1E3A8A'],
            ['name' => 'Forest Green',   'hex_code' => '#22543D'],
            ['name' => 'Terracotta',     'hex_code' => '#E07A5F'],
            ['name' => 'Sage Green',     'hex_code' => '#8DA399'],
            ['name' => 'Dusty Pink',     'hex_code' => '#DCAE96'],
            ['name' => 'Mustard Yellow', 'hex_code' => '#FFDB58'],
            ['name' => 'Khaki Tan',      'hex_code' => '#C3B091'],
            ['name' => 'Olive Drab',     'hex_code' => '#6B8E23'],
            ['name' => 'Burgundy Red',   'hex_code' => '#800020'],
            ['name' => 'Lilac Purple',   'hex_code' => '#C8A2C8'],
            ['name' => 'Espresso Brown', 'hex_code' => '#4B3621'],
            ['name' => 'Sky Blue',       'hex_code' => '#87CEEB'],
        ];

        foreach ($colors as $color) {
            // Pake updateOrCreate biar gak duplicate kalo di-seed ulang
            Color::updateOrCreate(
                ['name' => $color['name']], // Cek berdasarkan nama
                ['hex_code' => $color['hex_code']] // Update hex-nya
            );
        }
    }
}