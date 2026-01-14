<?php

namespace App\Livewire\Navbar;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class CartBadge extends Component
{
    #[On('cart_updated')]
    public function updateBadge()
    {
        
    }

    public function render()
    {
        $userId = Auth::id();

        $count = 0;
        if ($userId) {
            $count = CartItem::whereHas('cart', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->sum('quantity');
        }

        return view('livewire.navbar.cart-badge', [
            'count' => $count
        ]);
    }
}