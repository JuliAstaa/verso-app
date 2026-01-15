<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $products = Product::latest()->paginate(20);
        return view('pages.admin.products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.product-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            // Validasi Data Produk Utama
            'category_id' => 'required|exists:categories,id', // Pastikan kategori beneran ada di DB
            'name'        => 'required|string|max:255|unique:products,name',
            'description' => 'nullable|string',
            'base_price'  => 'required|numeric|min:0', // Jangan sampe harga minus
            'weight'      => 'required|integer|min:0', // Berat dalam gram, ga boleh minus
            'is_active'   => 'boolean',

            // Validasi Varian (Array)
            // User wajib input minimal 1 varian (Ukuran & Warna)
            'variants'             => 'required|array|min:1',
            'variants.*.size_id'   => 'required|exists:sizes,id',
            'variants.*.color_id'  => 'required|exists:colors,id',
            'variants.*.stock'     => 'required|integer|min:0',
            // Harga varian boleh kosong (nanti ambil dari base_price), tapi kalau diisi harus angka
            'variants.*.price'     => 'nullable|numeric|min:0', 

            // 3. Validasi Gambar (Array)
            // Boleh null (kalau males upload), tapi kalau ada isinya harus gambar
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB per foto

        ], [
            //Custom Error. Biar gak bingung baca error
            'category_id.required' => 'Kategori wajib dipilih bro.',
            'category_id.exists'   => 'Kategori yang dipilih gak valid.',
            'name.unique'          => 'Nama produk ini udah ada, ganti nama lain ya.',
            'base_price.required'  => 'Harga dasar wajib diisi.',
            'weight.required'      => 'Berat produk wajib diisi (gram).',
            
            // Pesan error buat Array Varian
            'variants.required'       => 'Minimal harus bikin satu varian produk (Size/Warna).',
            'variants.*.stock.required' => 'Stok varian wajib diisi.',
            'variants.*.stock.min'      => 'Stok gak boleh minus.',
            'variants.*.size_id.required' => 'Ukuran wajib dipilih.',
            'variants.*.color_id.required' => 'Warna wajib dipilih.',

            // Pesan error buat Gambar
            'images.*.image' => 'File harus berupa gambar (jpg, png, webp).',
            'images.*.max'   => 'Ukuran gambar kegedean! Maksimal 2MB per foto.',
        ]);

        try {
                DB::transaction(function() use ($request) {

                // simpan ke main product a.k.a table products
                $product = Product::create([
                    'category_id' => $request->category_id,
                    'name'        => $request->name,
                    'slug'        => Str::slug($request->name), // Bikin slug otomatis: "Baju Baru" -> "baju-baru"
                    'description' => $request->description,
                    'base_price'  => $request->base_price,
                    'weight'      => $request->weight,
                    'is_active'   => $request->has('is_active') ? true : false, // Checkbox handling
                ]);

                // simpan variant produk ke table variant
                foreach($request->variants as $variant) {
                    $product->variants()->create([
                        'size_id'  => $variant['size_id'],
                        'color_id' => $variant['color_id'],
                        'sku'      => Str::slug($request->name),
                        'stock'    => $variant['stock'],
                        // Kalau harga varian kosong, pake harga dasar produk
                        'price'    => $variant['price'] ?? $product->base_price,
                    ]);
                }

                // simpan gambar
                if($request->hasFile('images')) {
                    foreach($request->file('images') as $file) {
                        $path = $file->store('products', 'public');
                        $product->images()->create([
                            'image_path' => $path
                        ]);
                    }
                }
            });

            return redirect()->route('admin.products.index')->with('success', 'Berhasil menambahkan produk baru!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan '. $e->getMessage());
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        //
        
        return view('pages.admin.product-edit', ['id' => $product]);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Validasi input
        $request->validate([
            // Validasi Data Produk Utama
            'category_id' => 'required|exists:categories,id', // Pastikan kategori beneran ada di DB
            'name'        => 'required|string|max:255|unique:products,name,'. $product->id,
            'description' => 'nullable|string',
            'base_price'  => 'required|numeric|min:0', // Jangan sampe harga minus
            'weight'      => 'required|integer|min:0', // Berat dalam gram, ga boleh minus
            'is_active'   => 'boolean',

            // Validasi Varian (Array)
            // User wajib input minimal 1 varian (Ukuran & Warna)
            'variants'             => 'required|array|min:1',
            'variants.*.size_id'   => 'required|exists:sizes,id',
            'variants.*.color_id'  => 'required|exists:colors,id',
            'variants.*.stock'     => 'required|integer|min:0',
            // Harga varian boleh kosong (nanti ambil dari base_price), tapi kalau diisi harus angka
            'variants.*.price'     => 'nullable|numeric|min:0', 

            // 3. Validasi Gambar (Array)
            // Boleh null (kalau males upload), tapi kalau ada isinya harus gambar
            'images'   => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB per foto

        ], [
            //Custom Error. Biar gak bingung baca error
            'category_id.required' => 'Kategori wajib dipilih bro.',
            'category_id.exists'   => 'Kategori yang dipilih gak valid.',
            'name.unique'          => 'Nama produk ini udah ada, ganti nama lain ya.',
            'base_price.required'  => 'Harga dasar wajib diisi.',
            'weight.required'      => 'Berat produk wajib diisi (gram).',
            
            // Pesan error buat Array Varian
            'variants.required'       => 'Minimal harus bikin satu varian produk (Size/Warna).',
            'variants.*.stock.required' => 'Stok varian wajib diisi.',
            'variants.*.stock.min'      => 'Stok gak boleh minus.',
            'variants.*.size_id.required' => 'Ukuran wajib dipilih.',
            'variants.*.color_id.required' => 'Warna wajib dipilih.',

            // Pesan error buat Gambar
            'images.*.image' => 'File harus berupa gambar (jpg, png, webp).',
            'images.*.max'   => 'Ukuran gambar kegedean! Maksimal 2MB per foto.',
        ]);

        try {
                DB::transaction(function() use ($request, $product) {

                // simpan ke main product a.k.a table products
                $product->update([
                    'category_id' => $request->category_id,
                    'name'        => $request->name,
                    'slug'        => Str::slug($request->name), // Bikin slug otomatis: "Baju Baru" -> "baju-baru"
                    'description' => $request->description,
                    'base_price'  => $request->base_price,
                    'weight'      => $request->weight,
                    'is_active'   => $request->has('is_active') ? true : false, // Checkbox handling
                ]);

                // hapus yang lama, biar ga duplikas pas diupdate
                $product->variants()->delete();

                // simpan variant produk ke table variant
                foreach($request->variants as $variant) {
                    $product->variants()->create([
                        'size_id'  => $variant['size_id'],
                        'color_id' => $variant['color_id'],
                        'sku'      => Str::slug($request->name),
                        'stock'    => $variant['stock'],
                        // Kalau harga varian kosong, pake harga dasar produk
                        'price'    => $variant['price'] ?? $product->base_price,
                    ]);
                }

                // hapus gambar yang lama, supaya ga numpuk dan apk jadi berat
                if($request->has('delete_images')) {
                    foreach($request->delete_images as $imageId) {
                        $image = \App\Models\ProductImage::find($imageId);

                        if($image) {
                            \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);

                            $image->delete();
                        }
                    }
                }

                // simpan gambar
                if($request->hasFile('images')) {
                    foreach($request->file('images') as $file) {
                        $path = $file->store('products', 'public');
                        $product->images()->create([
                            'image_path' => $path
                        ]);
                    }
                }
            });

            return redirect()->route('admin.products.index')->with('success', 'Berhasil menambahkan produk baru!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan '. $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // INI SOFT DELET BTW
        // NOTE: KARENA NI SOFT DELETE, GAMBAR GAMBAR PRODUCT GA IKUT KEHAPUS, JADINYA NUMPUK

        try {
            $product->delete();

            return redirect()->route('admin.products.index')->with('success', 'Berhasil hapus product');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
        }
    }
}
