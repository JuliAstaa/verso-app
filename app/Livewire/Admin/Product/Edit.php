<?php

namespace App\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\ProductImage; // Buat hapus gambar satuan
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Services\ProductService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{
    use WithFileUploads;

    public $productId;
    public $name, $description, $category_id, $base_price, $weight, $is_active;
    public $searchColor = '';
    public $searchSize = '';
    // Gambar
    public $newImages = []; // Upload baru
    public $oldImages = []; // Gambar lama dari DB
    
    // Varian
    public $selectedColors = [];
    public $selectedSizes = [];
    public $variants = [];

    protected $rules = [
        'category_id' => 'required',
        'name' => 'required|string|max:255',
        'base_price' => 'required|numeric|min:0',
        'weight' => 'required|integer|min:0',
        'newImages.*' => 'nullable|image|max:2048', 
        'variants' => 'required|array|min:1',
        'variants.*.stock' => 'required|integer|min:0',
        'variants.*.price' => 'required|numeric|min:0',
    ];

    // --- STEP 1: TARIK DATA LAMA ---
    public function mount($id)
    {
        $product = Product::with(['variants.color', 'variants.size', 'images'])->findOrFail($id);

        $this->productId = $product->id;
        $this->category_id = $product->category_id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->base_price = $product->base_price;
        $this->weight = $product->weight;
        $this->is_active = (bool) $product->is_active;
        $this->oldImages = $product->images; // Collection gambar lama

        // Populate Checkbox Warna & Size berdasarkan varian yg ada
        $this->selectedColors = $product->variants->pluck('color_id')->unique()->toArray();
        $this->selectedSizes = $product->variants->pluck('size_id')->unique()->toArray();

        // Populate Tabel Varian (Mapping dari DB ke Array Livewire)
        foreach ($product->variants as $v) {
            $this->variants[] = [
                'color_id'    => $v->color_id,
                'size_id'     => $v->size_id,
                'label_color' => $v->color->name, // PENTING BUAT LABEL
                'label_size'  => $v->size->code,  // PENTING BUAT LABEL
                'sku'         => $v->sku,
                'stock'       => $v->stock,
                'price'       => $v->price,
            ];
        }
    }

    // --- LOGIC GENERATE SAMA PERSIS KAYA CREATE ---
    public function generateVariants()
    {
        
        $this->variants = []; 
        if (empty($this->selectedColors) || empty($this->selectedSizes)) return;

        foreach ($this->selectedColors as $colorId) {
            foreach ($this->selectedSizes as $sizeId) {
                $color = Color::find($colorId);
                $size = Size::find($sizeId);
                $skuName = Str::slug($this->name . '-' . $color->name . '-' . $size->code);

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

    // --- FITUR KHUSUS EDIT: HAPUS GAMBAR LAMA ---
    public function deleteOldImage($imageId)
    {
        $img = ProductImage::find($imageId);
        if ($img) {
            // Hapus file fisik
            if (Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete(); // Hapus dari DB
            
            // Refresh list gambar lama
            $this->oldImages = ProductImage::where('product_id', $this->productId)->get();
            $this->dispatch('swal:success', ['title' => 'Terhapus', 'text' => 'Gambar berhasil dihapus']);
        }
    }

    public function update(ProductService $service)
    {
        $this->validate();

        try {
            $product = Product::findOrFail($this->productId);
            
            $productData = [
                'category_id' => $this->category_id,
                'name' => $this->name,
                'description' => $this->description,
                'base_price' => $this->base_price,
                'weight' => $this->weight,
                'is_active' => $this->is_active,
            ];

            // Panggil Service Update
            $service->updateProduct($product, $productData, $this->variants, $this->newImages);

            session()->flash('success', 'Produk Berhasil Diupdate!');
            return redirect()->route('admin.products.index');

        } catch (\Exception $e) {
            $this->dispatch('swal:error', ['text' => 'Gagal Update: ' . $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.admin.product.edit', [
            'categories' => Category::where('is_active', true)->get(),
            'colors' =>  Color::where('name', 'like', '%' . $this->searchColor . '%')->get(),
            'sizes' => Size::where('code', 'like', '%' . $this->searchSize . '%')->get(),
        ]);
    }
}