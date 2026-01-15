<?php

namespace App\Livewire\Navbar;

use Livewire\Component;
use App\Models\Category;

class CategoryDropdown extends Component
{
    public function render()
    {
        return view('livewire.navbar.category-dropdown', [
            'categories' => Category::all()
        ]);
    }
}
