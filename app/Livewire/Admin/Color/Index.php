<?php

namespace App\Livewire\Admin\Color;

use App\Models\Color;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $orderBy = 'desc';

    // Reset pagination setiap kali user melakukan pencarian
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $isModalOpen = false;
    public $name, $hex_code;
    public $colorId = null;

    protected $rules = [
        'name' => ['required', 'string', 'max:30'],
        'hex_code' => ['required', 'string', 'max:7', 'regex:/^#([a-f0-9]{6})$/i']
    ];

    protected $messages = [
        'name.required' => 'Nama warna wajib diisi',
        'hex_code.required' => 'Hex code warna wajib diisi',
        'hex_code.regex' => 'Format hex code salah! (Contoh: #FFFFFF)'
    ];

    public function create() {
        $this->reset(['name', 'hex_code']); // Kosongin form
        $this->isModalOpen = true; // Buka modal
    }

   

    public function edit($id)
    {
        $color = Color::findOrFail($id);
        
        $this->colorId = $id;          
        $this->name = $color->name;    
        $this->hex_code = $color->hex_code; 
        
        $this->isModalOpen = true;     
    }

    public function save() {
        try {
            // valdasi as always
            $this->validate();
            
            // dd($this->name, $this->hex_code);
            // save ke database
            if ($this->colorId) {
            // --- UPDATE MODE ---
                $color = Color::findOrFail($this->colorId);
                $color->update([
                    'name' => Str::title($this->name),
                    'hex_code' => Str::upper($this->hex_code)
                ]);
                $this->reset(['name', 'hex_code', 'colorId']);
            } else {
                // --- CREATE MODE ---
                Color::create([
                    'name' => Str::title($this->name),
                    'hex_code' => Str::upper($this->hex_code)
                ]);
                $this->reset(['name', 'hex_code', 'colorId']);
            }

            
            $this->dispatch('swal:success', [
                'title' => 'Berhasil!',
                'text' => 'Data warna berhasil disimpan.',
            ]);
            $this->isModalOpen = false;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan '. $e->getMessage());
        }
    }
    
    public function cancel(){
    // 1. Reset Form dulu
    $this->reset(['name', 'hex_code', 'colorId']);
    
    // 2. Baru tutup modalnya
    $this->isModalOpen = false;
}

    // Fungsi untuk menghapus warna
    public function confirmDelete($id)
    {
        // Kirim perintah ke JS untuk buka popup
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Yakin hapus warna ini?',
            'text' => 'Data tidak bisa kembali loh!'
        ]);
    }
    #[On('deleteConfirmed')]
    public function delete($id)
    {
        $color = Color::find($id);
        if ($color) {
            $color->delete();
            $this->dispatch('swal:success', [
                'title' => 'Terhapus!',
                'text' => 'Data warna berhasil dihapus selamanya.',
            ]);
        }
    }

    public function render()
    {
        // Query data dengan filter pencarian
        $colors = Color::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('hex_code', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', $this->orderBy)
            ->paginate(32); // Menampilkan 10 data per halaman

        return view('livewire.admin.color.index', compact('colors'));
    }
}