<?php

namespace App\Livewire\Landing;

use Livewire\Component;
use App\Models\Category;

class Categories extends Component
{
    public function render()
    {
        $categoryChunks = Category::latest()->get()->chunk(14);

        return view('livewire.landing.categories', [
            'categoryChunks' => $categoryChunks
        ]);
    }
}
