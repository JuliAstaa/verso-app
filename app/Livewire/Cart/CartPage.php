<?php

namespace App\Livewire\Cart;

use Livewire\Component;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;

class CartPage extends Component
{
    public $selectedItems = []; 
    public $selectAll = true;

    #[On('cart_updated')]
    public function refreshCart()
    {
        $allIds = $this->items()->pluck('id')->map(fn($id) => (string)$id)->toArray();

        $this->selectedItems = array_values(array_unique(array_merge($this->selectedItems, $allIds)));

        $this->syncSelectAllStatus();
    }

    public function mount()
    {
        $this->selectAllItems();
    }

    #[Computed]
    public function items()
    {
        return CartItem::whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
        ->with(['productVariant.product', 'productVariant.color', 'productVariant.size']) 
        ->get();
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectAllItems();
        } else {
            $this->selectedItems = [];
        }
    }

    public function updatedSelectedItems()
    {
        $this->syncSelectAllStatus();
    }

    private function selectAllItems()
    {
        $this->selectedItems = $this->items()->pluck('id')->map(fn($id) => (string)$id)->toArray();
        $this->selectAll = count($this->selectedItems) > 0;
    }

    private function syncSelectAllStatus()
    {
        $itemsCount = $this->items()->count();
        $selectedCount = count($this->selectedItems);
        $this->selectAll = ($itemsCount > 0 && $selectedCount === $itemsCount);
    }

    #[Computed]
    public function totalPrice()
    {
        return $this->items()->whereIn('id', $this->selectedItems)
            ->sum(fn($item) => $item->price * $item->quantity);
    }

    #[Computed]
    public function totalSelectedQty()
    {
        return $this->items()->whereIn('id', $this->selectedItems)->sum('quantity');
    }

    public function incrementQty($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->increment('quantity');
            $this->dispatch('cart_updated'); 
        }
    }

    public function decrementQty($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item && $item->quantity > 1) {
            $item->decrement('quantity');
            $this->dispatch('cart_updated');
        }
    }

    public function removeItem($itemId)
    {
        $item = CartItem::find($itemId);
        if ($item) {
            $item->delete();
            $this->selectedItems = array_values(array_diff($this->selectedItems, [(string)$itemId]));
            $this->syncSelectAllStatus();
            $this->dispatch('cart_updated');
        }
    }

    public function removeSelected()
    {
        if (empty($this->selectedItems)) return;

        CartItem::whereIn('id', $this->selectedItems)->delete();

        $this->selectedItems = [];
        
        $this->selectAll = false;

        $this->dispatch('cart_updated');
    
        $this->dispatch('notify', message: 'Items removed successfully');
    }

    public function checkout()
    {
        if (empty($this->selectedItems)) {
            // Kasih notif error biar user ngeh
            $this->dispatch('swal:toast', [
                'type' => 'error', 
                'text' => 'Pilih minimal satu barang dulu ya!'
            ]);
            return;
        }

        return redirect()->route('checkout');
    }

    public function render()
    {
        return view('livewire.cart.cart-page');
    }
}