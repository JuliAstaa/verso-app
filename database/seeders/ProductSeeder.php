<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // Pakai lokalisasi Indonesia biar nama produknya relevan dikit

        // 1. Pastikan Master Data Ada Dulu
        // Kita ambil semua ID yang ada biar bisa dirandom
        $categoryIds = Category::pluck('id')->toArray();
        $colorIds = Color::pluck('id')->toArray();
        $sizeIds = Size::pluck('id')->toArray();

        // Kalau master data kosong, stop dulu
        if (empty($categoryIds) || empty($colorIds) || empty($sizeIds)) {
            $this->command->error('HARAP ISI DULU DATA KATEGORI, WARNA, DAN SIZE!');
            return;
        }

        // 2. Loop Bikin 50 Produk
        for ($i = 0; $i < 50; $i++) {
            
            $name = $faker->unique()->words(3, true); // Nama produk 3 kata
            $basePrice = $faker->numberBetween(50000, 750000); // Harga 50rb - 750rb

            // Create Product Utama
            $product = Product::create([
                'category_id' => $faker->randomElement($categoryIds),
                'name'        => Str::title($name),
                'slug'        => Str::slug($name) . '-' . Str::random(5),
                'description' => $faker->paragraph(3),
                'base_price'  => $basePrice,
                'weight'      => $faker->numberBetween(100, 1000), // 100gr - 1kg
                'is_active'   => $faker->boolean(80), // 80% Peluang Aktif, 20% Non-Aktif
            ]);

            // 3. Create Variants (Tiap produk punya 3-5 varian acak)
            // Kita ambil 2-3 warna acak dan 2-3 size acak buat dikombinasiin
            $randomColors = $faker->randomElements($colorIds, rand(1, 3));
            $randomSizes = $faker->randomElements($sizeIds, rand(2, 4));

            foreach ($randomColors as $cId) {
                foreach ($randomSizes as $sId) {
                    $colorName = Color::find($cId)->name;
                    $sizeCode = Size::find($sId)->code;
                    
                    ProductVariant::create([
                        'product_id' => $product->id,
                        'color_id'   => $cId,
                        'size_id'    => $sId,
                        'sku'        => strtoupper(Str::slug($product->name) . '-' . $colorName . '-' . $sizeCode),
                        'stock'      => $faker->numberBetween(0, 50), // Ada yg stok 0 biar seru
                        'price'      => $basePrice + $faker->randomElement([0, 5000, 10000]), // Kadang harga varian beda dikit
                    ]);
                }
            }

            // 4. Create Dummy Image (Biar tabel gak kosong melompong)
            // Kita pake placeholder image online aja biar gakuh menuhin storage
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/dummy.jpg', // Biarin null atau isi string dummy kalau mau
                'is_primary' => true,
            ]);
        }

        $this->command->info('✅ Berhasil menanam 50 Bibit Produk Unggulan!');
    }
}