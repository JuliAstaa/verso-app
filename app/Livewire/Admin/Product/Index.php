<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;




class Index extends Component
{

    use WithPagination;

    public $search = '';
    public $filterCategory = '';
    public $filterStatus = ''; // Buat filter Active/Non-Active
    public $filterPrice = '';
    public $filterSort = 'latest'; // Default urutan terbaru

    // Reset pagination kalau user ngetik search/filter
    public function updatedSearch() { $this->resetPage(); }
    public function updatedFilterCategory() { $this->resetPage(); }
    public function updatedFilterStatus() { $this->resetPage(); }
    public function updatedFilterPrice() { $this->resetPage(); }

    public function confirmDelete($id) 
    {
        
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Hapus Produk??',
            'text' => 'Data akan dihapus sementara (Soft Delete).',
        ]);
    }

    // --- EKSEKUSI DELETE ---
    #[On('deleteConfirmed')]
    public function delete($id, ProductService $service) 
    {
        try {

            $service->deleteProduct($id);

            $this->dispatch('swal:success', [
                'title' => 'Terhapus!',
                'text' => 'Kategori berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['text' => 'Gagal menghapus data.']);
        }
    }

    // ... function render dan lain-lain ...

    public function toggleStatus($id)
    {
        try {
            $product = Product::findOrFail($id);
            
            // Jurus membalik boolean (!true = false, !false = true)
            $product->update([
                'is_active' => !$product->is_active
            ]);

            // Kirim notifikasi 'Toast' (Popup kecil yg ilang sendiri)
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'title' => 'Status: ' . ($product->is_active ? 'Aktif' : 'Non-Aktif'),
                'text' => 'Perubahan berhasil disimpan.'
            ]);

        } catch (\Exception $e) {
            $this->dispatch('swal:toast', [
                'type' => 'error',
                'title' => 'Gagal Update Status',
                'text' => $e->getMessage()
            ]);
        }
    }

    public function render()
    {
        // 1. Start Query
        $query = Product::with('category');

        // 2. Filter Search (Nama & Deskripsi)
        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        // 3. Filter Category
        if ($this->filterCategory) {
            $query->where('category_id', $this->filterCategory);
        }

        // 4. Filter Status (Active / Inactive)
        // Kita cek pakai string '1' atau '0' karena value dari select option itu string
        if ($this->filterStatus !== '') {
            $query->where('is_active', $this->filterStatus);
        }

        // 5. Filter Price Range (Contoh Logic Rupiah)
        if ($this->filterPrice) {
            switch ($this->filterPrice) {
                case 'under-100000':
                    $query->where('base_price', '<', 100000);
                    break;

                case '100000-500000':
                    $query->whereBetween('base_price', [100000, 500000]);
                    break;

                case 'above-500000':
                    $query->where('base_price', '>', 500000);
                    break;
            }
        }

        // 6. Sorting (Urutan)
        switch ($this->filterSort) {
            case 'price_asc': $query->orderBy('base_price', 'asc'); break;
            case 'price_desc': $query->orderBy('base_price', 'desc'); break;
            case 'oldest': $query->orderBy('created_at', 'asc'); break;
            default: $query->latest(); break; // Default Latest
        }

        return view('livewire.admin.product.index', [
            'products' => $query->paginate(10),
            'categories' => Category::all(), // Kirim data kategori buat dropdown
        ]);
    }
}
