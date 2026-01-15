<?php

namespace App\Services;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// --- IMPORT UNTUK INTERVENTION IMAGE V3 (SAMA KEK KATEGORI) ---
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductService {

    public function createProduct(array $data, array $variants, array $images) {
        return DB::transaction(function () use ($data, $variants, $images) {
            
            // 1. Simpan Data Produk
            $product = Product::create([
                'category_id' => $data['category_id'],
                'description' => $data['description'],
                'name'        => Str::title($data['name']),
                'slug'        => Str::slug($data['name']). '-' . Str::random(5),
                'base_price'  => $data['base_price'],
                'weight'      => $data['weight'],
                'is_active'   => $data['is_active'],
            ]);

            // 2. Simpan Variants
            foreach($variants as $variant) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id'   => $variant['color_id'],
                    'size_id'    => $variant['size_id'],
                    'sku'        => $variant['sku'],
                    'stock'      => $variant['stock'],
                    'price'      => $variant['price'],
                ]);
            }

            // 3. Upload Gambar (Panggil Helper V3)
            if (!empty($images)) {
                foreach ($images as $index => $img) {
                    $this->uploadAndCompressImage($product, $img, $index === 0);
                }
            }
            
            return $product;
        });
    }

    public function updateProduct(Product $product, array $data, array $variants, array $newImages = [])
    {
        return DB::transaction(function () use ($product, $data, $variants, $newImages) {
            
            // 1. Update Produk
            $product->update([
                'category_id' => $data['category_id'],
                'name'        => Str::title($data['name']),
                'slug'        => Str::slug($data['name']) . '-' . Str::random(5),
                'description' => $data['description'],
                'base_price'  => $data['base_price'],
                'weight'      => $data['weight'],
                'is_active'   => $data['is_active'],
            ]);

            // 2. Reset Variant
            $product->variants()->delete(); 

            foreach ($variants as $v) {
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id'   => $v['color_id'],
                    'size_id'    => $v['size_id'],
                    'sku'        => $v['sku'],
                    'stock'      => $v['stock'],
                    'price'      => $v['price'],
                ]);
            }

            // 3. Upload Gambar Baru (Panggil Helper V3)
            if (!empty($newImages)) {
                foreach ($newImages as $img) {
                    $this->uploadAndCompressImage($product, $img, false);
                }
            }

            return $product;
        });
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // Hapus fisik gambar
        foreach($product->images as $img) {
            if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
        }
        
        $product->delete();
    }

    // --- HELPER KHUSUS INTERVENTION V3 ---
    private function uploadAndCompressImage($product, $imageFile, $isPrimary)
    {
        // 1. Setup Image Manager (Driver GD)
        $manager = new ImageManager(new Driver());

        // 2. Baca File Gambar
        $image = $manager->read($imageFile->getRealPath());

        // 3. Resize Pintar (scaleDown)
        $image->scaleDown(width: 1000);

        // 4. Encode ke WebP (Quality 80)
        $encoded = $image->toWebp(quality: 80);

        // 5. Generate Nama & Simpan
        $filename = Str::random(40) . '.webp';
        $path = 'products/' . $filename;

        // Simpan hasil encode (harus di-cast ke string)
        Storage::disk('public')->put($path, (string) $encoded);

        // 6. Catat di DB
        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $path,
            'is_primary' => $isPrimary,
        ]);
    }
}