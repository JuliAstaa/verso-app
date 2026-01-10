<?php

namespace App\Livewire\Admin\Size;

use App\Models\Size;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Throwable;

class Create extends Component
{
    public $name;
    
    protected $rules = [
        'name' => 'required|string|max:10|unique:sizes,name'
    ];

    protected $messages = [
        'name.required' => 'Nama ukuran wajib diisi.',
        'name.unique' => 'Ukuran ini sudah ada di database'
    ];

    public function save() {
        try {
            //validasi
            $this->validate();

            //simpan data
            Size::create([
                'name' => Str::upper( $this->name),
            ]);
            
            // redirect
            session()->flash('success', 'Ukuran berhasil ditambahkan');

            //reset form
            $this->reset('name');


        } catch (Throwable $th) {
            // error selain validasi
            session()->flash('error', 'Terjadi kesalahan '. $th->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.size.create');
    }
}
