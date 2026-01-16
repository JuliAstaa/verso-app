<?php

namespace App\Livewire\Admin\Product;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Services\ProductService;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;

    public $searchColor = '';
    public $searchSize = '';

    public $name, $description, $category_id, $base_price, $weight, $is_active = true;
    public $images = [];

    // buat variant product ne
    public $selectedColors = [];
    public $selectedSizes = [];
    public $variants = [];

    // rules atau validation
    protected $rules = [
        'category_id' => 'required',
        'name' => 'required|string|max:255',
        'description' => 'required|string', // Tambahkan validasi deskripsi
        'base_price' => 'required|numeric|min:0',
        'weight' => 'required|integer|min:0',
        
        // 👇 UPDATE BAGIAN INI: Tambahkan mimes:webp
        'images' => 'required|array|min:1', // Pastikan minimal ada 1 gambar (opsional)
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048', 
        
        'variants' => 'required|array|min:1',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.price' => 'required|numeric|min:0',
    ];

    // buat variant dari produk
    public function generateVariants() {
        if(empty($this->selectedColors) || empty($this->selectedSizes)) {
            $this->dispatch('swal:error', ['text' => 'Pilih minimal 1 warna dan 1 size']);
            return;
        }

        $this->variants = [];

        foreach($this->selectedColors as $colorId) {
            foreach($this->selectedSizes as $sizeId) {
                $color = Color::find($colorId);
                $size = Size::find($sizeId);
                $skuName = Str::slug($this->name. '-' . $color->name. '-' . $size->code);

                $this->variants[] = [
                    'color_id' => $colorId,
                    'size_id' => $sizeId,
                    'label_color' => $color->name,
                    'label_size' => $size->code,
                    'sku' => strtoupper($skuName),
                    'stock' => 10,
                    'price' => $this->base_price ?? 0,
                ];
            }
        }
    }

    // hapus variant
    public function removeVariant($index) {
        unset($this->variants[$index]);
        $this->variants = array_values($this->variants);
    }

    public function removeColor($id)
    {
        // Hapus ID dari array, terus re-index biar urutannya rapi (0, 1, 2...)
        $this->selectedColors = array_values(array_diff($this->selectedColors, [$id]));
    }

    public function removeSize($id)
    {
        $this->selectedSizes = array_values(array_diff($this->selectedSizes, [$id]));
    }

    // simpen data cuy
    public function save(ProductService $service) {

        // dd("TEMBUS CUK");

        $this->validate();

        try {
            $productData = [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
                'base_price' => $this->base_price,
                'weight' => $this->weight,
                'is_active' => $this->is_active,
            ];

          

            // panggil servicenya wok
            $service->createProduct($productData, $this->variants, $this->images);
            session()->flash('success', 'Produk Berhasil Dibuat!');
            return redirect()->route('admin.products.index');
        } catch (\Exception $e) {
            // dd("ERROR TERTANGKAP: " . $e->getMessage());
            $this->dispatch('swal:error', ['text' => 'Gagal: ' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.product.create', [
            'categories' => Category::where('is_active', true)->get(),
            'colors' =>  Color::where('name', 'like', '%' . $this->searchColor . '%')->get(),
            'sizes' => Size::where('code', 'like', '%' . $this->searchSize . '%')->get(),
        ]);
    }
}
