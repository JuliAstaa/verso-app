<?php

namespace App\Livewire\Admin\Size;

use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    public $sizeId;
    public $name;

    protected $messages = [
        'name.required' => 'Nama ukuran wajib diisi.',
        'name.unique' => 'Ukuran ini sudah ada di database'
    ];

    public function mount($id) {
        $size = Size::findOrFail($id);
        $this->sizeId = $size->id;
        $this->name = $size->name;
    }

    public function update() {
        try {
            // validasi
            $this->validate([
            'name' => [
                'required',
                'string',
                'max:10',
                Rule::unique('sizes', 'name')->ignore($this->sizeId)
                ]
            ]);

            // cari size berdasarkan $this->sieId
            $size = Size::findOrFail($this->sizeId);

            // lakukan update
            $size->update([
                'name' => Str::upper($this->name),
            ]);

            // pesan session
            session()->flash('success', 'Ukuran berhasil diperbaharui!');

            // redirect ke main menu admin
            return redirect()->route('admin.sizes.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Gagal update: ' . $e->getMessage());
        }


    }

    public function render()
    {
        return view('livewire.admin.size.update');
    }
}
