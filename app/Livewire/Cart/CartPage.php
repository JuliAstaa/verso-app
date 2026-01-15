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
            ->with('productVariant.product')
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
            // Hapus ID dari array selectedItems agar hitungan (count) di UI sinkron
            $this->selectedItems = array_values(array_diff($this->selectedItems, [(string)$itemId]));
            $this->syncSelectAllStatus();
            $this->dispatch('cart_updated');
        }
    }

    public function removeSelected()
    {
        if (empty($this->selectedItems)) return;

        // 1. Hapus dari database
        CartItem::whereIn('id', $this->selectedItems)->delete();

        // 2. Kosongkan array pilihan agar UI bersih
        $this->selectedItems = [];
        
        // 3. Set checkbox Select All ke false
        $this->selectAll = false;

        // 4. Update data (Computed items akan refresh otomatis)
        $this->dispatch('cart_updated');
    
        $this->dispatch('notify', message: 'Items removed successfully');
    }

    public function render()
    {
        return view('livewire.cart.cart-page');
    }
}