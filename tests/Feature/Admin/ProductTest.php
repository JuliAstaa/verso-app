<?php

namespace Tests\Feature\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color; // Mantap, sudah Singular!
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_bisa_membuat_produk_komplit_dengan_varian_dan_gambar()
    {
        // 1. Setup Data Pendukung
        $category = Category::create(['name' => 'Jaket', 'slug' => 'jaket']);
        $size = Size::create(['name' => 'XL']); 
        $color = Color::create(['name' => 'Hitam', 'hex_code' => '#000000']); 

        $name = 'Produk Test ' . uniqid();
        $slug = \Illuminate\Support\Str::slug($name);

        Storage::fake('public'); // Simulasi storage

        // 2. Siapkan Data Input Form (Complex Array)
        $payload = [
            'category_id' => $category->id,
            'name'        => $name,
            'description' => 'Jaket anti angin',
            'base_price'  => 150000,
            'weight'      => 500,
            'is_active'   => 1, 
            
            // Array Variants
            'variants' => [
                [
                    'size_id'  => $size->id,
                    'color_id' => $color->id,
                    'sku'      => $slug,
                    'stock'    => 10,
                    'price'    => 160000, 
                ]
            ],

            // Array Images
            'images' => [
                UploadedFile::fake()->image('depan.jpg'),
                UploadedFile::fake()->image('belakang.jpg'),
            ]
        ];

        // // 3. Action
        // $response = $this->post(route('admin.products.store'), $payload);

        // // TAMBAHAN: Cek apa isi session error-nya
        // $response->dumpSession(); 

        // // 4. Assert Dasar
        // $response->assertRedirect(route('admin.products.index'));

        // 3. Action: Tembak ke route store
        $response = $this->post(route('admin.products.store'), $payload);

        // 4. Assert Dasar
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');

        // 5. Assert Database Utama
        $this->assertDatabaseHas('products', [
            'name' => $name,
            'slug' => $slug,
            'base_price' => 150000,
            'is_active' => 1,
        ]);

        // 6. Assert Database Anak (Variants)
        $product = Product::where('name', $name)->first();
        
        $this->assertDatabaseHas('product_variants', [
            'product_id' => $product->id,
            'size_id'    => $size->id,
            'stock'      => 10,
            'price'      => 160000,
        ]);

        // 7. Assert Database & Storage (Images)
        // Cek tabel product_images punya 2 baris
        $this->assertCount(2, $product->images);
        
        // Cek fisik file ada di storage (Pakai assertTrue biar VS Code gak merah)
        foreach ($product->images as $img) {
            $this->assertTrue(Storage::disk('public')->exists($img->image_path));
        }
    }

    public function test_admin_gagal_bikin_produk_kalau_lupa_isi_varian()
    {
        $category = Category::create(['name' => 'Kaos', 'slug' => 'kaos']);

        $response = $this->post(route('admin.products.store'), [
            'category_id' => $category->id,
            'name'        => 'Kaos Polos',
            'base_price'  => 50000,
            'weight'      => 200,
            // variants sengaja dikosongin
        ]);
        

        // Harus error validasi di field 'variants'
        $response->assertSessionHasErrors('variants');
        
        // Pastikan TIDAK ADA data masuk ke database (Transaction Rollback Works!)
        $this->assertDatabaseCount('products', 0);
    }

    public function test_admin_bisa_update_produk_ganti_varian_dan_hapus_gambar()
    {
        // 1. SETUP: Bikin Produk Lama, Varian Lama, Gambar Lama
        $category = Category::create(['name' => 'Kemeja', 'slug' => 'kemeja']);
        $sizeLama = Size::create(['name' => 'L']);
        $colorLama = Color::create(['name' => 'Merah', 'hex_code' => '#FF0000']);
        
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Kemeja Flanel',
            'slug' => 'kemeja-flanel',
            'base_price' => 100000,
            'weight' => 200,
            'is_active' => 1
        ]);

        // Varian Lama (Harusnya nanti ILANG diganti yang baru)
        $product->variants()->create([
            'size_id' => $sizeLama->id,
            'color_id' => $colorLama->id,
            'sku' => 'VAR-LAMA',
            'stock' => 5,
            'price' => 100000
        ]);

        // Gambar Lama (Kita simulasiin file fisiknya ada)
        Storage::fake('public');
        $fileLama = UploadedFile::fake()->image('foto_lama.jpg');
        $pathLama = $fileLama->store('products', 'public');
        
        $imageLama = $product->images()->create(['image_path' => $pathLama]);

        // 2. DATA BARU (Buat Update)
        $sizeBaru = Size::create(['name' => 'XL']);
        $colorBaru = Color::create(['name' => 'Biru', 'hex_code' => '#0000FF']);
        
        $payload = [
            'category_id' => $category->id,
            'name'        => 'Kemeja Flanel Premium', // Ganti Nama
            'description' => 'Edisi baru',
            'base_price'  => 250000, // Ganti Harga
            'weight'      => 300,
            'is_active'   => 1,
            
            // Varian BARU (Ini yang harus masuk DB)
            'variants' => [
                [
                    'size_id'  => $sizeBaru->id,
                    'color_id' => $colorBaru->id,
                    'stock'    => 50,
                    'price'    => 250000,
                    // SKU biasanya di-generate controller atau input manual
                ]
            ],

            // Request Hapus Gambar Lama
            'delete_images' => [
                $imageLama->id 
            ],

            // Upload Gambar Baru
            'images' => [
                UploadedFile::fake()->image('foto_baru.jpg')
            ]
        ];

        // 3. ACTION: HIT ROUTE UPDATE
        $response = $this->put(route('admin.products.update', $product->id), $payload);

        // 4. ASSERTION (PEMBUKTIAN)
        $response->assertRedirect(route('admin.products.index'));
        $response->assertSessionHas('success');

        // Cek Data Utama Berubah
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Kemeja Flanel Premium', // Nama berubah
            'base_price' => 250000
        ]);

        // Cek Varian: Pastikan CUMA ADA 1 (Yang baru), yang lama harusnya udah kehapus
        // Kalau codingan "$product->variants()->delete()" kamu lupa, ini bakal error (Count jadi 2)
        $this->assertCount(1, $product->fresh()->variants);
        $this->assertDatabaseHas('product_variants', [
            'size_id' => $sizeBaru->id, // Punya size baru
            'stock' => 50
        ]);

        // Cek Gambar: 
        // 1. Gambar lama harus hilang dari DB
        $this->assertDatabaseMissing('product_images', ['id' => $imageLama->id]);
        
        // 2. File fisik lama harus hilang dari storage
        $this->assertFalse(Storage::disk('public')->exists($pathLama));

        // 3. Gambar baru harus masuk
        $this->assertCount(1, $product->fresh()->images);
    }

    public function test_admin_bisa_hapus_produk_soft_delete()
    {
        // 1. Setup Data
        $category = Category::create(['name' => 'Topi', 'slug' => 'topi']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Topi Miring',
            'slug' => 'topi-miring',
            'base_price' => 50000,
            'weight' => 100
        ]);

        // 2. Action: Delete
        $response = $this->delete(route('admin.products.destroy', $product->id));

        // 3. Assert
        $response->assertRedirect(route('admin.products.index'));
        
        // Cek Soft Delete (Data masih ada di DB, tapi deleted_at terisi)
        $this->assertSoftDeleted('products', [
            'id' => $product->id,
            'name' => 'Topi Miring'
        ]);
        
        // Pastikan TIDAK hilang permanen (Hard Delete)
        $this->assertDatabaseHas('products', [
            'id' => $product->id
        ]);
    }
}