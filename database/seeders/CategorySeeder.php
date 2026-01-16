<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; // <--- Jangan lupa import Model Category
use Illuminate\Support\Str; // <--- Import Str buat bikin slug

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar Kategori (Bisa lu tambah sesuka hati)
        $categories = [
            'T-Shirts',
            'Shirts',
            'Denim Pants',
            'Hoodies & Sweatshirts',
            'Jackets / Outerwear',
            'Skirts',
            'Dresses',
            'Chinos',
            'Sportswea',
            'Knitwear',
        ];

        foreach ($categories as $name) {
            // Bikin Slug otomatis dari Nama
            $slug = Str::slug($name);

            Category::updateOrCreate(
                ['slug' => $slug], // Cek: Kalau slug ini udah ada, update aja
                [
                    'name' => $name,
                    'slug' => $slug,
                    'images' => null, // Default null dulu, nanti upload sendiri di admin
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}