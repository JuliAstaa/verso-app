<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\OrderItem;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithPagination;
    public $showLoadMore = true;

    public $showPagination = true;

    public $limit = 12;
    public $columns = 6;

    #[Url(history: true)]
    public $search = '';

    #[Url(as: 'c', history: true)]
    public $selectedCategories = [];

    #[Url(as: 'sort', history: true)]
    public $sortOrder = 'default';

    public function gridClass()
    {
        return [
            4 => 'lg:grid-cols-4',
            5 => 'lg:grid-cols-5',
            6 => 'lg:grid-cols-6',
        ][$this->columns] ?? 'lg:grid-cols-6';
    }

    public function loadMore()
    {
        $this->limit += 6;
    }

   public function mount($limit = null, $columns = null)
    {
        $this->selectedCategories = is_array($this->selectedCategories) 
            ? $this->selectedCategories 
            : ($this->selectedCategories ? [$this->selectedCategories] : []);

        if ($limit) $this->limit = $limit;
        if ($columns) $this->columns = $columns;

        if (request()->has('search')) {
            $this->search = request('search');
        }

        if (request()->has('c')) {
            $this->selectedCategories = [request('c')];
        } elseif (request()->has('category')) {
            $cat = Category::where('slug', request('category'))->first();
            if ($cat) {
                $this->selectedCategories = [$cat->id];
            }
        }
    }


    // Helper to format numbers (e.g., 1200 -> 1.2rb)
    public function formatCompactNumber($number)
    {
        if ($number >= 1000) {
            return number_format($number / 1000, 1) . 'k+'; // Indonesian "ribu"
        }
        return $number;
    }

    public function addToCart($productId)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::with('variants')->find($productId);
        if (!$product) return;

        $variant = $product->variants->where('stock', '>', 0)->first();

        if (!$variant) {
            $this->dispatch('notify', message: 'Sorry, this product is out of stock!');
            return;
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        $cartItem = CartItem::where('cart_id', $cart->id)
                            ->where('product_variant_id', $variant->id)
                            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
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
        // 1. Eager Load 'variants' dan 'reviews' biar ringan
        $query = Product::query()
            ->with(['variants', 'reviews']) 
            ->where('is_active', true);

        // 2. Filter Search
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // 3. Filter Category
        if (!empty($this->selectedCategories)) {
            $categories = is_array($this->selectedCategories) 
                        ? array_filter($this->selectedCategories) 
                        : [$this->selectedCategories];
            
            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }
        }

        // 4. Sorting
        $query->reorder(); // Reset default order
        if ($this->sortOrder === 'price_high') {
            $query->orderBy('base_price', 'desc'); 
        } elseif ($this->sortOrder === 'price_low') {
            $query->orderBy('base_price', 'asc');
        } elseif ($this->sortOrder === 'newest') {
            $query->orderBy('created_at', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        // 5. Pagination & Count
        $totalCount = $query->count();
        $products = $query->paginate($this->limit);

        // 6. Update UI State
        $this->dispatch('update-total-count', count: $totalCount);
        $this->showPagination = ($this->showPagination !== false);
        $this->showLoadMore = ($this->showLoadMore !== false) && ($products->count() < $totalCount);

        return view('livewire.product.product-list', [
            'products' => $products,
            'allCategories' => Category::all(),
            'totalCount' => $totalCount
        ]);
    }
}