<?php

namespace App\Livewire\Admin\Color;

use App\Models\Color;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Update extends Component
{
    public $colorId, $name, $hex_code;

    protected $messages = [
        'name.required' => 'Nama warna wajib diisi',
        'hex_code.required' => 'Hex code warna wajib diisi',
        'hex_code.regex' => 'Format hex code salah! (Contoh: #FFFFFF)'
    ];

    public function mount($id){
        $color = Color::findOrFail($id);
        $this->colorId = $color->id;
        $this->name = $color->name;
        $this->hex_code = $color->hex_code;
    }

    public function update(){
        //
        try {
            $this->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('colors', 'name')->ignore($this->colorId)],
            'hex_code' => ['required', 'string', 'max:7', 'regex:/^#([a-f0-9]{6})$/i']
            ]);

            // cari color berdasarkan id
            $color = Color::findOrFail($this->colorId);

            // update cuy
            $color->update([
                'name' => $this->name,
                'hex_code' => $this->hex_code,
            ]);

            // buat session berhasil dan redirect ke main menu
            session()->flash('success', 'Warna berhasil diperbaharui!');
            return redirect()->route('admin.colors.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan '. $e->getMessage());
        }

    }
    public function render()
    {
        return view('livewire.admin.color.update');
    }
}
