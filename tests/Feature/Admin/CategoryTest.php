<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile; // Untuk bikin file gambar palsu
use Illuminate\Support\Facades\Storage; // Untuk simulasi folder storage
use Tests\TestCase;

class CategoryTest extends TestCase
{
    // Reset database setiap kali test jalan
    use RefreshDatabase;

    // --- TEST CREATE ---

    public function test_admin_bisa_membuat_kategori_baru_dengan_gambar()
    {
        // 1. Setup: Pura-pura folder 'public' itu kosong/fake
        Storage::fake('public');

        // 2. Bikin gambar dummy (avatar.jpg)
        $file = UploadedFile::fake()->image('avatar.jpg');

        // 3. Action: POST ke route store
        $response = $this->post(route('admin.categories.store'), [
            'name' => 'Kemeja Flannel',
            'images' => $file, // Upload file
        ]);

        // 4. Assert Redirect & Session
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success');

        // 5. Assert Database: Pastikan data masuk & slug ter-generate
        $this->assertDatabaseHas('categories', [
            'name' => 'Kemeja Flannel',
            'slug' => 'kemeja-flannel',
            'is_active' => true,
        ]);

        // 6. Assert Storage: Cek apakah file beneran ada di folder 'categories'
        $category = Category::where('name', 'Kemeja Flannel')->first();
        
        $this->assertNotNull($category->images); // Pastikan kolom images gak null
        Storage::disk('public')->assertExists($category->images); // Cek fisik file
    }

    public function test_admin_gagal_buat_kategori_kalau_nama_kosong()
    {
        $response = $this->post(route('admin.categories.store'), [
            'name' => '', // Kosong
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('categories', 0);
    }

    // --- TEST UPDATE ---

    public function test_admin_bisa_update_kategori_tanpa_ganti_gambar()
    {
        // Setup data awal
        $category = Category::create([
            'name' => 'Celana Jeans', 
            'slug' => 'celana-jeans',
            'images' => 'categories/old-image.jpg' // Simulasi path file lama
        ]);

        // Action: Update cuma ganti nama
        $response = $this->put(route('admin.categories.update', $category->id), [
            'name' => 'Celana Chino',
            // images tidak dikirim (artinya admin gak ganti gambar)
        ]);

        $response->assertRedirect(route('admin.categories.index'));

        // Assert DB: Nama berubah
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Celana Chino',
            'slug' => 'celana-chino',
        ]);

        // Assert Logic: Gambar LAMA masih aman (tidak jadi null)
        $category->refresh(); // Ambil data terbaru dari DB
        $this->assertEquals('categories/old-image.jpg', $category->images);
    }

    public function test_admin_bisa_update_kategori_dan_ganti_gambar_baru()
    {
        Storage::fake('public');
        
        // Buat data lama
        $category = Category::create([
            'name' => 'Jaket', 
            'slug' => 'jaket',
            'images' => 'categories/jaket-lama.jpg'
        ]);

        // Siapkan Gambar baru
        $newFile = UploadedFile::fake()->image('jaket-baru.jpg');

        // Action Update
        $response = $this->put(route('admin.categories.update', $category->id), [
            'name' => 'Jaket Kulit',
            'images' => $newFile
        ]);

        $response->assertRedirect(route('admin.categories.index'));

        // Ambil data terbaru
        $category->refresh();

        // 1. Pastikan nama file di database BERUBAH (Bukan yang lama lagi)
        $this->assertNotEquals('categories/jaket-lama.jpg', $category->images);
        
        // 2. Pastikan file baru tersimpan fisik di storage
        Storage::disk('public')->assertExists($category->images);
    }

    // --- TEST DELETE ---

    public function test_admin_bisa_soft_delete_kategori()
    {
        $category = Category::create([
            'name' => 'Topi', 
            'slug' => 'topi'
        ]);

        $response = $this->delete(route('admin.categories.destroy', $category->id));

        $response->assertRedirect(route('admin.categories.index'));
        $response->assertSessionHas('success');
        
        // Cek Soft Delete (deleted_at terisi)
        $this->assertSoftDeleted('categories', [
            'id' => $category->id,
            'name' => 'Topi'
        ]);
    }
}