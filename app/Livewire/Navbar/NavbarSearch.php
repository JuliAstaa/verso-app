<?php

namespace App\Livewire\Navbar;

use Livewire\Component;
use App\Models\Product;

class NavbarSearch extends Component
{
    public $searchQuery = '';
    public $suggestions = []; 

    public function updatedSearchQuery()
    {
        if (strlen($this->searchQuery) >= 1) {
            $this->suggestions = Product::where('name', 'like', '%' . $this->searchQuery . '%')
                ->select('id', 'name')
                ->limit(20)
                ->get()
                ->toArray();
        } else {
            $this->suggestions = [];
        }
    }

    public function handleSearch()
    {
        if (!empty($this->searchQuery)) {
            return;
            }
            
        redirect()->route('product.category', ['search' => $this->searchQuery]);
    }

    public function render()
    {
        return view('livewire.navbar.navbar-search');
    }
}