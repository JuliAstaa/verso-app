<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategori dasar
        $baseCategories = [
            'Electronics',
            'Fashion Pria',
            'Fashion Wanita',
            'Gadget',
            'Aksesoris',
            'Kesehatan',
            'Kecantikan',
            'Perlengkapan Rumah',
            'Hobi',
            'Koleksi',
            'Otomotif',
            'Makanan',
            'Minuman',
            'Buku',
            'Alat Tulis',
        ];

        $categories = [];

        // Generate sampai 60 kategori
        $i = 1;
        while (count($categories) < 60) {
            foreach ($baseCategories as $base) {
                if (count($categories) >= 60) {
                    break;
                }
                $categories[] = $base . ' ' . $i;
            }
            $i++;
        }

        foreach ($categories as $name) {
            $slug = \Illuminate\Support\Str::slug($name);

            \App\Models\Category::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $name,
                    'slug' => $slug,
                    'images' => null,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
