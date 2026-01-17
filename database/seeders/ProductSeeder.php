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
        $faker = Faker::create('id_ID');

        // 1. Cek Ketersediaan Master Data (Warna & Size wajib ada buat varian)
        $colorIds = Color::pluck('id')->toArray();
        $sizeIds = Size::pluck('id')->toArray();

        if (empty($colorIds) || empty($sizeIds)) {
            $this->command->error('❌ STOP! Harap isi dulu data COLOR dan SIZE di database.');
            return;
        }

        // 2. Data Katalog Spesifik (Request Kamu)
        $catalog = [
            [
                'category' => 'Denim',
                'name' => 'Verso Heritage Denim',
                'desc' => 'Denim klasik dengan potongan timeless. Cocok untuk kamu yang suka gaya simpel, maskulin, dan nggak pernah ketinggalan zaman.',
                'price' => 450000,
                'weight' => 800,
            ],
            [
                'category' => 'Skirts',
                'name' => 'Verso Indigo Denim Skirt',
                'desc' => 'Rok denim warna indigo dengan potongan modern. Memberikan look kasual yang tetap feminin dan easy to style.',
                'price' => 320000,
                'weight' => 500,
            ],
            [
                'category' => 'T-Shirts',
                'name' => 'Verso Midnight Tee',
                'desc' => 'Kaos warna gelap dengan kesan elegan dan misterius. Cocok buat kamu yang suka tampilan simple tapi classy.',
                'price' => 150000,
                'weight' => 200,
            ],
            [
                'category' => 'Sweaters',
                'name' => 'Verso Mustard Knit Sweater',
                'desc' => 'Sweater rajut warna mustard yang hangat dan stylish. Memberikan kesan cozy dan standout di cuaca dingin.',
                'price' => 375000,
                'weight' => 600,
            ],
            [
                'category' => 'Chinos',
                'name' => 'Verso Olive Classic Chinos',
                'desc' => 'Celana chinos warna olive dengan potongan rapi dan modern. Cocok untuk smart casual maupun daily outfit.',
                'price' => 399000,
                'weight' => 500,
            ],
            [
                'category' => 'Skirts',
                'name' => 'Verso Onyx Denim Skirt',
                'desc' => 'Rok denim warna gelap dengan kesan bold dan edgy. Mudah dipadukan dengan berbagai atasan favoritmu.',
                'price' => 335000,
                'weight' => 500,
            ],
            [
                'category' => 'Polo Shirts',
                'name' => 'Verso Professional Polo',
                'desc' => 'Polo shirt dengan tampilan rapi dan profesional. Cocok untuk kerja, meeting santai, atau acara semi-formal.',
                'price' => 250000,
                'weight' => 300,
            ],
            [
                'category' => 'Jackets',
                'name' => 'Verso Pure Windbreaker',
                'desc' => 'Jaket ringan anti angin dengan desain sporty dan modern. Cocok untuk outdoor activity atau traveling.',
                'price' => 499000,
                'weight' => 400,
            ],
            [
                'category' => 'Skirts',
                'name' => 'Verso Sand Denim Skirt',
                'desc' => 'Rok denim warna sand yang cerah dan soft. Memberikan tampilan fresh, ringan, dan feminin.',
                'price' => 320000,
                'weight' => 500,
            ],
            [
                'category' => 'Sweaters',
                'name' => 'Verso Shadow Knit',
                'desc' => 'Sweater rajut dengan warna gelap dan desain minimalis. Cocok untuk tampilan cozy yang tetap elegan.',
                'price' => 380000,
                'weight' => 600,
            ],
            [
                'category' => 'Jackets',
                'name' => 'Verso Shield Windbreaker',
                'desc' => 'Jaket windbreaker dengan proteksi ekstra dari angin dan cuaca ringan. Desain modern dan fungsional untuk aktivitas luar ruangan.',
                'price' => 550000,
                'weight' => 450,
            ],
            [
                'category' => 'Dresses',
                'name' => 'Verso Sky Breeze Dress',
                'desc' => 'Dress ringan dengan bahan adem dan flowy. Cocok untuk cuaca panas, liburan, atau acara santai.',
                'price' => 420000,
                'weight' => 350,
            ],
            [
                'category' => 'Chinos',
                'name' => 'Verso Smart Executive Chinos',
                'desc' => 'Chinos dengan potongan rapi dan kesan profesional. Ideal untuk kerja, meeting, atau acara formal kasual.',
                'price' => 410000,
                'weight' => 500,
            ],
            [
                'category' => 'Polo Shirts',
                'name' => 'Verso Soft Petal Polo',
                'desc' => 'Polo shirt dengan warna lembut dan bahan halus. Memberikan kesan kalem, bersih, dan elegan.',
                'price' => 260000,
                'weight' => 300,
            ],
        ];

        // 3. Eksekusi Seeding
        foreach ($catalog as $item) {
            
            // A. Handle Category (Cari atau Buat)
            // Biar gak error "category not found", kita create on the fly kalau belum ada
            $category = Category::firstOrCreate(
                ['name' => $item['category']], 
                [
                    'slug' => Str::slug($item['category']),
                    'is_active' => true
                ]
            );

            // B. Create Product
            $product = Product::create([
                'category_id' => $category->id,
                'name'        => $item['name'],
                'slug'        => Str::slug($item['name']),
                'description' => $item['desc'],
                'base_price'  => $item['price'],
                'weight'      => $item['weight'],
                'is_active'   => true, // Default aktif semua
            ]);

            // C. Create Variants (Acak Warna & Size)
            // Kita kasih tiap produk 2-3 warna acak dan 2-4 size acak
            $randomColors = $faker->randomElements($colorIds, rand(2, 3));
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
                        'stock'      => $faker->numberBetween(10, 50), // Stok 10-50
                        'price'      => $item['price'], // Harga varian samain aja dulu sama harga dasar
                    ]);
                }
            }

            // D. Create Dummy Image
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/dummy.jpg', // Masih null sesuai request
                'is_primary' => true,
            ]);
        }

        $this->command->info('✅ Berhasil menanam ' . count($catalog) . ' Produk Katalog Spesifik!');
    }
}