<?php

namespace App\Livewire\Admin\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

// buat compress gambar
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $isModalOpen = false;

    // Properti Form
    public $categoryId = null;
    public $name;
    public $slug;
    public $newImage; // Untuk nampung file baru yang diupload
    public $oldImage; // Untuk nampung path gambar lama dari DB (buat preview)
    public $is_active = true;

    // Validasi
    protected function rules() 
    {
        return [
            'name' => 'required|string|max:50',
            'is_active' => 'boolean'
        ];
    }

    // Reset pagination kalau user searching
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // --- BUKA MODAL CREATE ---
    public function create() 
    {
        $this->resetForm();
        $this->isModalOpen = true;
    }

    // --- BUKA MODAL EDIT ---
    public function edit($id) 
    {
        $category = Category::findOrFail($id);
        
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->oldImage = $category->images; // Ambil path dari DB
        $this->is_active = (bool) $category->is_active;
        
        $this->isModalOpen = true;
    }

    // --- PROSES SIMPAN (CREATE/UPDATE) ---
    public function save() 
    {
        $this->validate();

        // 1. Handle Gambar
        $imagePath = $this->oldImage; // Default pake gambar lama
        
        if ($this->newImage) {
            // Siapkan Manager Gambar
            $manager = new ImageManager(new Driver());

            // Baca file yang diupload user
            $image = $manager->read($this->newImage->getRealPath());

            // RESIZE (Biar dimensi gak kegedean, misal max lebar 800px)
            // aspect ratio tetep dijaga biar ga gepeng
            $image->scale(width: 800); 

            // COMPRESS (Quality 75% itu sweet spot, mata manusia ga bisa bedain)
            // Kita ubah jadi .webp sekalian biar modern & ringan
            $encoded = $image->toWebp(quality: 75);

            // Bikin Nama File Unik
            $filename = 'categories/' . Str::random(40) . '.webp';

            // impan ke Storage Public
            Storage::disk('public')->put($filename, $encoded);
            
            // Update path buat disimpen ke DB
            $imagePath = $filename;

            // Hapus gambar lama kalau ada
            if ($this->oldImage && Storage::disk('public')->exists($this->oldImage)) {
                Storage::disk('public')->delete($this->oldImage);
            }
        }

        // 2. Siapkan Data
        $data = [
            'name' => Str::title($this->name),
            'slug' => Str::slug($this->name),
            'images' => $imagePath, // Masuk ke kolom 'images' di DB
            'is_active' => $this->is_active ? 1 : 0,
        ];

        // 3. Eksekusi
        if ($this->categoryId) {
            // Update
            Category::find($this->categoryId)->update($data);
            $message = 'Kategori berhasil diperbarui!';
        } else {
            // Create
            Category::create($data);
            $message = 'Kategori berhasil ditambahkan!';
        }

        // 4. Tutup & Reset
        $this->dispatch('swal:success', [
            'title' => 'Berhasil!',
            'text' => $message
        ]);
        
        $this->isModalOpen = false;
        $this->resetForm();
    }

    // --- RESET FORM ---
    public function resetForm() 
    {
        $this->reset(['categoryId', 'name', 'slug', 'newImage', 'oldImage', 'is_active']);
        $this->resetErrorBag();
        $this->isModalOpen = false;
    }


    
    // --- CONFIRM DELETE ---
    public function confirmDelete($id) 
    {
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Hapus Kategori?',
            'text' => 'Data akan dihapus sementara (Soft Delete).',
        ]);
    }

    // --- EKSEKUSI DELETE ---
    #[On('deleteConfirmed')]
    public function delete($id) 
    {
        try {
            // Normalisasi ID kalau dikirim via array swal
            $id = is_array($id) ? $id['id'] : $id;
            
            $category = Category::findOrFail($id);
            $category->delete(); // Soft delete

            $this->dispatch('swal:success', [
                'title' => 'Terhapus!',
                'text' => 'Kategori berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['text' => 'Gagal menghapus data.']);
        }
    }

    public function render()
    {
        return view('livewire.admin.category.index', [
            'categories' => Category::where('name', 'like', '%'.$this->search.'%')
                ->latest()
                ->paginate(8)
        ]);
    }
}