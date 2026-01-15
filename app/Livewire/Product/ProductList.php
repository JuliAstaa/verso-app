<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductList extends Component
{
    public $showLoadMore = true;
    public $limit = 12;

    public $columns = 6;

    public function loadMore()
    {
        $this->limit += 6;
    }

    public function mount($limit = null, $columns = null)
    {
        if($limit){
            $this->limit = $limit;

            if($limit <= 4){
                $this->showLoadMore = false;
            }
        }

        if($columns){
            $this->columns = $columns;
        }
    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::with('variants')->find($productId);

        $variant = $product->variants->where('stock', '>', 0)->first();

        if(!$variant) {
            $this->dispatch('notify', message: 'Sorry, this product is out of stock!');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)->where('product_variant_id', $variant->id)->first();

        if($cartItem){
            $cartItem->increment('quantity');
        }else{
            CartItem::create([
                'cart_id' => $cart->id,
                'product_variant_id' => $variant->id,
                'quantity' => 1,
                'price' => $variant->price,
            ]);
        }

        $this->dispatch('cart_updated');

        $this->dispatch('notify', message: 'Successfully added to cart!');
    }

    public function render()
    {
        
        $products = Product::limit($this->limit)->get();
        

        return view('livewire.product.product-list', [
            'products' => $products
        ]);
    }
}
