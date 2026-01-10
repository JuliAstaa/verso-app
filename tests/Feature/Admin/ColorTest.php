<?php

namespace Tests\Feature\Admin;

use App\Models\Color; 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ColorTest extends TestCase
{
    use RefreshDatabase;

    // TAMBAHKAN 'test_' DI DEPAN NAMA FUNGSI
    
    // public function test_admin_bisa_melihat_halaman_index_warna()
    // {
    //     // 1. Buat data dummy
    //     Colors::create(['name' => 'Merah', 'hex_code' => '#FF0000']);

    //     // 2. Kunjungi halaman index
    //     $response = $this->get(route('admin.colors.index'));

    //     // 3. Cek apakah status OK (200)
    //     $response->assertStatus(200);
        
    //     // 4. Cek apakah data 'Merah' muncul di layar
    //     $response->assertSee('Merah');
    // }

    public function test_admin_bisa_menambah_warna_baru()
    {
        // Data input
        $dataInput = [
            'name' => 'Biru Langit',
            'hex_code' => '00BFFF' 
        ];

        // Tembak method STORE
        $response = $this->post(route('admin.colors.store'), $dataInput);

        // Harusnya redirect balik ke index
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.colors.index'));
        
        // Cek session success
        $response->assertSessionHas('success');

        // Cek Database
        $this->assertDatabaseHas('colors', [
            'name' => 'Biru Langit',
            'hex_code' => '00BFFF'
        ]);
    }

    public function test_admin_gagal_tambah_warna_kalau_input_tidak_valid()
    {
        // Input Kosong
        $response = $this->post(route('admin.colors.store'), [
            'name' => '', 
            'hex_code' => ''
        ]);

        // Harusnya error di session
        $response->assertSessionHasErrors(['name', 'hex_code']);
        
        // Database harusnya kosong
        $this->assertDatabaseCount('colors', 0);
    }

    public function test_admin_bisa_update_warna()
    {
        // 1. Buat data awal
        $color = Color::create([
            'name' => 'Kuning', 
            'hex_code' => 'FFFF00'
        ]);

        // 2. Data baru untuk update
        $dataUpdate = [
            'name' => 'Kuning Tua',
            'hex_code' => 'CCCC00'
        ];

        // 3. Tembak method UPDATE (PUT)
        $response = $this->put(route('admin.colors.update', $color->id), $dataUpdate);

        // 4. Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.colors.index'));
        $response->assertSessionHas('success');

        // Cek database apakah namanya berubah
        $this->assertDatabaseHas('colors', [
            'id' => $color->id,
            'name' => 'Kuning Tua',
            'hex_code' => 'CCCC00'
        ]);
    }

    public function test_admin_bisa_hapus_warna()
    {
        // 1. Buat data
        $color = Color::create([
            'name' => 'Hitam', 
            'hex_code' => '000000'
        ]);

        // 2. Tembak method DELETE
        $response = $this->delete(route('admin.colors.destroy', $color->id));

        // 3. Assert
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.colors.index'));
        $response->assertSessionHas('success');

        // 4. Pastikan data HILANG dari database
        $this->assertDatabaseMissing('colors', [
            'id' => $color->id,
            'name' => 'Hitam'
        ]);
    }
}