<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class ColorSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan data lama biar gak numpuk (Optional, kalau mau bersih)
        // Color::truncate(); 
        
        $faker = Faker::create();

        // Daftar kata sifat biar nama warnanya keren & variatif
        $adjectives = [
            'Dark', 'Light', 'Pale', 'Deep', 'Soft', 'Bright', 'Neon', 'Pastel', 
            'Metallic', 'Matte', 'Vivid', 'Electric', 'Royal', 'Antique', 'Hot', 
            'Cool', 'Warm', 'Fresh', 'Dusty', 'Rich'
        ];

        // Loop 200 kali
        for ($i = 0; $i < 200; $i++) {
            
            // Ambil kata sifat acak
            $adj = $faker->randomElement($adjectives);
            
            // Ambil nama warna dasar (Red, Blue, Indigo, dll)
            $baseColor = $faker->colorName; 

            // Gabung jadi "Neon Red" atau "Dark Blue"
            // Ditambah angka acak di belakang biar pasti unik (misal: Deep Red 42)
            $uniqueName = "$adj $baseColor " . $faker->numberBetween(1, 999);

            Color::create([
                'name'     => Str::title($uniqueName), // Bikin huruf besar awal
                'hex_code' => Str::upper($faker->hexColor), // Hex code: #AABBCC
            ]);
        }
    }
}