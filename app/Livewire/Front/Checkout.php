<?php

namespace App\Livewire\Front;

use App\Models\CartItem;
use App\Services\OrderService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Checkout extends Component
{
    public $address, $phone, $courier = 'jne';
    public $shippingCost = 15000; // Flat ongkir buat UAS

    public function mount()
    {
        // Redirect kalau keranjang kosong
        $hasItems = CartItem::whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))->exists();
        if (!$hasItems) return redirect()->route('cart');

        // Auto-fill dari profile
        $this->address = Auth::user()->profile->address ?? '';
        $this->phone = Auth::user()->profile->phone ?? '';
    }

    public function getGrandTotalProperty()
    {
        $items = CartItem::whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))
        ->with('productVariant')
        ->get();

    // 👇 TAMBAHKAN FILTER INI
    // Kita cuma hitung item yang variant-nya TIDAK NULL (Masih ada)
    $validItems = $items->filter(fn($item) => $item->productVariant !== null);

    $subTotal = $validItems->sum(fn($item) => $item->quantity * $item->productVariant->price);

    return $subTotal + $this->shippingCost;
    }

    public function placeOrder(OrderService $orderService)
    {
        $this->validate([
            'address' => 'required|min:10',
            'phone'   => 'required|numeric',
            'courier' => 'required',
        ]);

        $myCart = CartItem::whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))->with('productVariant')->get();

        try {
            // Panggil Service
            $order = $orderService->createOrder(Auth::user(), [
                'address'         => $this->address,
                'courier'         => $this->courier,
                'shipping_cost'   => $this->shippingCost,
                'recipient_phone' => $this->phone,
            ], $myCart);

            // Redirect ke Fake PG
            return redirect()->route('payment.show', ['order' => $order->id]);

        } catch (\Exception $e) {
            $this->dispatch('swal:toast', ['type' => 'error', 'text' => 'Gagal: ' . $e->getMessage()]);
        }
    }



    public function render()
    {
        $cartItems = CartItem::whereHas('cart', fn($q) => $q->where('user_id', Auth::id()))->get();
        return view('livewire.front.checkout', compact('cartItems'));
    }
}