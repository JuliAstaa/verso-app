<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('pages.admin.sizes');
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
        //
        $validated = $request->validate([
            'name' => 'required|string|max:10|unique:sizes,name'
        ],
        [
            'name.required' => 'Nama ukuran wajib diisi.',
            'name.unique' => 'Ukuran ini sudah ada di database'
        ]
    );

    try {
        Size::create($validated);

        return redirect()->route('admin.sizes.index')->with('success', 'Ukuran berhasil ditambahkan!');

    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan: '. $e->getMessage());
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        //
    }
                            
    /**
 * 
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        // Validasi dulu wok
        $validate = $request->validate([
            // buat unique tapi kecualikan id nya, supaya pas di save ga error
            'name' => 'required|string|max:10|unique:size,name,'. $size->id,
        ]);

        try {
            $size->update($validate);
            return redirect()->route('admin.sizes.index')->with('success', 'Ukuran berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Gagal update '. $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        try {
            $size->delete();

            return redirect()->route('admin.sizes.index')
                ->with('success', 'Ukuran berhasil dihapus!');

        } catch (\Exception $e) {
            return redirect()->route('admin.sizes.index')
                ->with('error', 'Gagal menghapus! Pastikan ukuran ini tidak sedang dipakai oleh produk apapun.');
        }
    }
}
