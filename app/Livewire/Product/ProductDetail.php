<?php

namespace App\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ProductDetail extends Component
{
    public $product;
    public $slug;
    public $selectedColor;
    public $selectedSize;
    public $quantity = 1;
    public $currentVariant;

    public function mount($slug)
    {
        $this->slug = $slug;
        
        $this->product = Product::with(['variants', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        if ($this->product->variants->count() > 0) {
            $this->currentVariant = $this->product->variants->first();
            
            $this->selectedColor = $this->currentVariant->color->name ?? '';
            $this->selectedSize = $this->currentVariant->size->name ?? '';
        }
    }

    public function updatedSelectedColor()
    {
        $this->updateVariant();
    }

    public function updatedSelectedSize()
    {
        $this->updateVariant();
    }

    public function updateVariant()
    {
        $variant = $this->product->variants
            ->where('color.name', $this->selectedColor)
            ->where('size.name', $this->selectedSize)
            ->first();

        if ($variant) {
            $this->currentVariant = $variant;
        }
    }

    public function increment()
    {
        if ($this->quantity < ($this->currentVariant->stock ?? 0)) {
            $this->quantity++;
        }
    }

    public function decrement()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function addToCart()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!$this->currentVariant || $this->currentVariant->stock <= 0) {
            $this->dispatch('notify', message: 'Sorry, this variant is out of stock!');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_variant_id', $this->currentVariant->id)
                            ->first();

        if ($cartItem) {
            if (($cartItem->quantity + $this->quantity) > $this->currentVariant->stock) {
                $this->dispatch('notify', message: 'Cannot add more. Stock reached.');
                return;
            }
            $cartItem->increment('quantity', $this->quantity);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $this->currentVariant->id,
                'quantity' => $this->quantity,
                'price' => $this->currentVariant->price,
            ]);
        }

        $this->dispatch('cart_updated'); 
        $this->dispatch('notify', message: 'Successfully added to cart!');
        
        session()->flash('success', 'Product added to cart!');
    }

    public function render()
    {
        return view('livewire.product.product-detail');
    }
}