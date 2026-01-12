<?php

namespace App\Livewire\Admin\Size;

use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $isModalOpen = false;
    public $search = '';
    public $orderBy = 'desc';
    public $name, $code;
    public $sizeId = null;

    public function updatingSearch() {
        $this->resetPage();
    }

    public function create() {
        $this->reset(['code', 'name']);
        $this->isModalOpen = true;
    }

    public function edit($id)
    {
        $color = Size::findOrFail($id);
        
        $this->sizeId = $id;          
        $this->code = $color->code;    
        $this->name = $color->name;    
        
        $this->isModalOpen = true;     
    }

    public function cancel() {
        $this->reset(['code', 'name', 'sizeId']);
        $this->isModalOpen = false;
    }

    public function save() {
        try {
            $validatedData = $this->validate([
                'code' => [
                    'required', 
                    'string', 
                    'max:5',
                    Rule::unique('sizes', 'code')->ignore($this->sizeId) 
                ],
                'name' => [
                    'required', 
                    'string', 
                    'max:10',
                    Rule::unique('sizes', 'name')->ignore($this->sizeId)
                ],
            ], [
                // Custom Messages (Opsional, pindahin dari $messages ke sini)
                'name.required' => 'Nama ukuran wajib diisi.',
                'name.unique' => 'Nama ukuran ini sudah ada.',
                'code.unique' => 'Kode ukuran ini sudah ada.',
            ]);

            if($this->sizeId) {
                $size = Size::findOrFail($this->sizeId);
                $size->update([
                    'code' => Str::upper($this->code),
                    'name' => Str::upper($this->name),
                    ]);
                    
                $this->reset(['code', 'name', 'sizeId']);
            } else {
                Size::create([
                    'code' => Str::upper($this->code),
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
