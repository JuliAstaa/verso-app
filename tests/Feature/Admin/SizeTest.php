<?php

namespace Tests\Feature\Admin;

use App\Models\Size;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SizeTest extends TestCase
{
    // Reset database setiap kali test jalan
    use RefreshDatabase;

    // --- PERHATIKAN NAMA FUNGSINYA DIAWALI 'test_' ---

    public function test_admin_bisa_menambah_size_baru()
    {
        // 1. Data input
        $dataInput = ['name' => 'XL'];

        // 2. Tembak Route (Pastikan route name di web.php benar)
        $response = $this->post(route('admin.sizes.store'), $dataInput);

        // 3. Cek Hasil
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.sizes.index'));
        $this->assertDatabaseHas('sizes', ['name' => 'XL']);
    }

    public function test_admin_gagal_tambah_size_kalau_nama_kosong()
    {
        $response = $this->post(route('admin.sizes.store'), ['name' => '']);
        
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('sizes', 0);
    }

    public function test_admin_gagal_tambah_size_duplikat()
    {
        // Buat data awal
        Size::create(['name' => 'L']);

        // Input data sama
        $response = $this->post(route('admin.sizes.store'), ['name' => 'L']);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('sizes', 1); 
    }
}