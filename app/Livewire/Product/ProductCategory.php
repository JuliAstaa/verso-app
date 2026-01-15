<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use Livewire\Attributes\Url;

class ProductCategory extends Component
{
    #[Url(history: true)]
    public $search = '';

    #[Url(as: 'c', history: true)]
    public $selectedCategory = null; 

    #[Url(as: 'sort', history: true)]
    public $sortOrder = 'default';

    public $totalProducts = 0;

    protected $listeners = ['update-total-count' => 'setTotalCount'];

    public function setTotalCount($count) {
        $this->totalProducts = $count;
    }

    public function mount()
    {
        if (request()->has('c')) {
            $this->selectedCategory = request('c');
        } 
        elseif (request()->has('category')) {
            $cat = Category::where('slug', request('category'))->first();
            if ($cat) {
                $this->selectedCategory = $cat->id;
            }
        }

        if (request()->has('search')) {
            $this->search = request('search');
        }
    }

    public function selectCategory($id)
    {
        $this->search = ''; 

        if ($this->selectedCategory == $id) {
            $this->selectedCategory = null;
            // Opsional: Anda bisa mengirimkan event jika ingin lebih responsif
            $this->dispatch('categoryUpdated', []); 
        } else {
            $this->selectedCategory = $id;
            $this->dispatch('categoryUpdated', [$id]);
        }
    }

    public function render()
    {
        $activeCategoryName = null;

        if ($this->selectedCategory) {
            $category = Category::where('id', $this->selectedCategory)->first();
            $activeCategoryName = $category ? $category->name : null;
        } 
        elseif ($this->search) {
            $firstProduct = Product::where('name', 'like', '%' . $this->search . '%')
                ->with('category')
                ->first();

            if ($firstProduct && $firstProduct->category) {
                $activeCategoryName = $firstProduct->category->name;
                
                $this->selectedCategory = $firstProduct->category->id;
            } else {
                $activeCategoryName = 'Hasil Pencarian';
            }
        }

        return view('livewire.product.product-category', [
            'allCategories' => Category::all(),
            'activeCategoryName' => $activeCategoryName
        ]);
    }
}