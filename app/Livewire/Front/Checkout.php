<?php

namespace App\Livewire\Front;

use Livewire\Component;
use Livewire\Attributes\Computed; // Fitur baru Livewire 3 buat itung-itungan otomatis
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart; // Sesuaikan model Cart kamu
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\OrderService;

class Checkout extends Component
{
    // 1. PROPERTY INPUTAN (Harus public biar bisa di wire:model)
    public $phone;
    public $address;
    public $receiverName;
    public $courier = 'jne'; // Default value
    public $paymentMethod = 'bca'; // Default value

    // 2. MOUNT (Jalan sekali pas halaman dibuka)
    // Fungsinya: Isi otomatis No HP & Alamat dari data user yg login
    public function mount()
    {
    $user = Auth::user();
        
        // 1. Cek apakah ada alamat yang baru dipilih dari session (modal navbar)
        $sessionAddressId = session('shipping_address_id');
        
        // 2. Cari alamatnya (pake ID dari session, atau default user, atau alamat pertama)
        $selectedAddress = $user->addresses()->where('id', $sessionAddressId)->first()
            ?? $user->addresses()->where('is_default', true)->first()
            ?? $user->addresses()->first();

        // 3. Autofill ke property form
        if ($selectedAddress) {
            $this->receiverName = $selectedAddress->receiver_name;
            $this->phone = $selectedAddress->phone;
            $this->address = $selectedAddress->detail . "\n" . 
                     $selectedAddress->village->name . ", " . 
                     $selectedAddress->district->name. ", " .
                     $selectedAddress->city->name . ", " . 
                     $selectedAddress->province->name . " " . 
                     $selectedAddress->postal_code;
            
        } else {
            // Fallback kalau bener-bener gak punya alamat
            $this->receiverName = $selectedAddress->receiver_name;
            $this->phone = $user->phone ?? '';
            $this->address = '';
        }

        if ($this->cartItems->isEmpty()) {
            return redirect()->route('pages.product-cart');
        }
    }

    // 3. COMPUTED: AMBIL DATA KERANJANG
    // Pake #[Computed] biar di-cache sama Livewire, gak query database terus2an
    #[Computed]
    public function cartItems()
    {
        // A. Cari dulu Keranjang milik User ini
        $cart = Cart::where('user_id', Auth::id())->first();

        // B. Kalau gak punya keranjang, balikin list kosong
        if (!$cart) {
            return collect();
        }

        // C. Kalau ada, ambil ISI-nya (CartItem) beserta Variant & Produknya
        return CartItem::where('cart_id', $cart->id)
            ->with(['productVariant.product', 'productVariant.color', 'productVariant.size'])
            ->get();
    }

    // 4. COMPUTED: HITUNG SUBTOTAL (Harga Barang Total)
    #[Computed]
    public function subTotal()
    {
        return $this->cartItems->sum(function($item) {
            return $item->productVariant->price * $item->quantity;
        });
    }

    // 5. COMPUTED: HITUNG ONGKIR (Berdasarkan Pilihan Kurir)
    // Ini bakal otomatis update kalau user ganti dropdown kurir di frontend
    #[Computed]
    public function shippingCost()
    {
        return match ($this->courier) {
            'jne' => 15000,
            'jnt' => 15000,
            'sicepat' => 15000, // Samain kayak text di option HTML kamu
            default => 0,
        };
    }

    // 6. COMPUTED: GRAND TOTAL (Subtotal + Ongkir)
    #[Computed]
    public function grandTotal()
    {
        return $this->subTotal + $this->shippingCost;
    }

    // 7. FUNGSI UTAMA: BAYAR SEKARANG
    public function placeOrder(OrderService $orderService)
    {
        $this->validate([
        'phone' => 'required|numeric|digits_between:10,14',
        'address' => 'required|min:10',
        'courier' => 'required|in:jne,jnt,sicepat',
        'paymentMethod' => 'required|in:bca,mandiri,qris',
        ]);

        // Data yang dibutuhin Service (Sesuaikan sama variabel di OrderService)
        $data = [
            'recipient_phone' => $this->phone,
            'address' => $this->address,
            'courier' => $this->courier,
            'shipping_cost' => $this->shippingCost,
        ];

        try {
            // 👇 INI DIA KUNCINYA! Panggil fungsi di Service yang udah kita benerin tadi
            $order = $orderService->createOrder(Auth::user(), $data, $this->cartItems);

            return redirect()->route('payment.show', ['order' => $order->id]);
            
        } catch (\Exception $e) {
            // Kalau stok habis, bakal kena tangkap disini
            $this->dispatch('notify', message: $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.front.checkout', ['cartItems' => $this->cartItems, 'shippingCost' => $this->shippingCost]);
    }
}