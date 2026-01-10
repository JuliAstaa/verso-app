<?php

namespace App\Livewire\Admin\Size;

use App\Models\Size;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $isModalOpen = false;
    public $search = '';
    public $orderBy = 'desc';
    public $name;
    public $sizeId = null;

    protected $rules = [
        'name' => 'required|string|max:10|unique:sizes,name'
    ];

    protected $messages = [
        'name.required' => 'Nama ukuran wajib diisi.',
        'name.unique' => 'Ukuran ini sudah ada di database'
    ];

    public function updatingSearch() {
        $this->resetPage();
    }

    public function create() {
        $this->reset('name');
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $color = Size::findOrFail($id);
        
        $this->sizeId = $id;          
        $this->name = $color->name;    
        
        $this->isModalOpen = true;     
    }

    public function cancel() {
        $this->reset(['name', 'sizeId']);
        $this->isModalOpen = false;
    }

    public function save() {
        try {
            $this->validate();

            if($this->sizeId) {
                $size = Size::findOrFail($this->sizeId);
                $size->update([
                    'name' => Str::upper($this->name),
                ]);

                $this->reset(['name', 'sizeId']);
            } else {
                Size::create([
                    'name'=> Str::upper($this->name),
                ]);
            }

            $this->dispatch('swal:success', [
                'title' => 'Berhasil!',
                'text' => 'Data size berhasil disimpan.',
            ]);
            $this->isModalOpen = false;

        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan '. $e->getMessage());
        }
    }

    public function confirmDelete($id) {
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Yakin mau hapus size ini?',
            'text' => 'Data yang sudah dihapus tidak bisa kembali lagi loh!',
        ]);
    }

    #[On('deleteConfirmed')]
    public function delete($id) {
        try {
            $size = Size::findOrFail($id);
            if($size) {
                $size->delete();
                $this->dispatch('swal:success', [
                    'title' => 'Terhapus!',
                    'text' => 'Data size berhasil terhapus selamanya!'
                ]);
            }
        } catch (\Exception $e) {
        
            $this->dispatch('swal:error', [
                'text' => 'Gagal Mengahapus, error'
            ]);

        }
    }


    public function render()
    {
        $sizes = Size::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', $this->orderBy)
            ->paginate(12); // Menampilkan 10 data per halaman

        return view('livewire.admin.size.index', compact('sizes'));
    }
}
