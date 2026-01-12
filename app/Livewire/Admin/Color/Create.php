<?php

namespace App\Livewire\Admin\Color;

use App\Models\Color;
use Livewire\Component;

class Create extends Component
{
    public $isModalOpen = false;
    public $name, $hex_code;

    protected $rules = [
        'name' => ['required', 'string', 'max:50'],
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

    public function save() {
        try {
            // valdasi as always
            $this->validate();

            // save ke database
            Color::create([
                'name' => $this->name,
                'hex_code' => $this->hex_code
            ]);

            // session msg
            session()->flash('success', 'Warna baru berhasil ditambahkan!');

            // reset form
            $this->reset(['name', 'hex_code']);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan '. $e->getMessage());
        }
    } 

    public function render()
    {
        return view('livewire.admin.color.create');
    }
}
