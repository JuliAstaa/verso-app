<?php

namespace App\Livewire\Product;

use Livewire\Component;

class ProductList extends Component
{
    public $showLoadMore = true;
    public $limit = 12;

    public function loadMore()
    {
        $this->limit += 6;
    }

    public function render()
    {
        $products = collect(range(1, $this->limit))->map(function($i) {
            return [
                'id' => $i,
                'name' => 'Celana panjang cargo pria slim fit khaki - ' . $i,
                'price' => 259050,
                'rating' => 4.9,
                'sold' => '2rb+',
                'location' => 'Kab. Badung',
                'image' => null
            ];
        });

        return view('livewire.product.product-list', [
            'products' => $products
        ]);
    }
}
