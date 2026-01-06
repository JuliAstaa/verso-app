<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::latest()->paginate(10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique' => 'Nama kategori ini sudah ada, cari nama lain.',
            'images.image' => 'File harus berupa gambar.',
            'images.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => true,
            ];

            if($request->hasFile('images') ){
                // simpan ke folder storage/app/public/categories
                $path = $request->file('images')->store('categories', 'public');
                $data['images'] = $path;
            } else {
                $data['images'] = null;
            }

            Category::create($data);

            return redirect()->route('admin.categories.index')->with('success', 'Berhasil menambahkan kategori baru!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan '. $e->getMessage());
        } 
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
         // validasi
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:categories,name,'. $category->id,
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ], [
            'name.required' => 'Nama kategori wajib diisi!',
            'name.unique' => 'Nama kategori ini sudah ada, cari nama lain.',
            'images.image' => 'File harus berupa gambar.',
            'images.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        try {
            $data = [
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'is_active' => true,
            ];

            if($request->hasFile('images') ){
                // simpan ke folder storage/app/public/categories
                $path = $request->file('images')->store('categories', 'public');
                $data['images'] = $path;
            } 

            $category->update($data);

            return redirect()->route('admin.categories.index')->with('success', 'Berhasil memperbaharui kategori!');

        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan '. $e->getMessage());
        } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('admin.categories.index')
                ->with('success', 'Kategori berhasil dihapus (Masuk ke sampah).');

        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Gagal menghapus kategori: ' . $e->getMessage());
        }
    }
}
