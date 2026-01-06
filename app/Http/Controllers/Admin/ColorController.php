<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $colors = Color::latest()->paginate(10);

        // return view('admin.colors.index', compact('colors'));
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
        $validate = $request->validate([
            'name' => 'required|string|max:50',
            'hex_code' => 'required|string|max:6'
        ],[
            'name.required' => 'Nama warna wajib diisi',
            'hex_code.required' => 'Hex code warna wajib diisi'
        ]);

        try {
            Color::create($validate);

            return redirect()->route('admin.colors.index')->with('success', 'Warna baru berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalah '. $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        //
        $validate = $request->validate([
            'name' => 'required|string|max:50',
            'hex_code' => 'required|string|max:6'
        ],[
            'name.required' => 'Nama warna wajib diisi',
            'hex_code.required' => 'Hex code warna wajib diisi'
        ]);

        try {
            $color->update($validate);

            return redirect()->route('admin.colors.index')->with('success', 'Warna baru berhasil diperbaharui!');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalah '. $e->getMessage() . '. Gagal update warna');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        //
        try {
            $color->delete();

            return redirect()->route('admin.colors.index')->with('success', 'Warna berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.colors.index')->with('error', 'Gagal menghapus warna! Pastikan warna ini tidak sedang dipakai oleh produk apapun');
        }
    }
}
