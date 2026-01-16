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

class Checkout extends Component
{
    // 1. PROPERTY INPUTAN (Harus public biar bisa di wire:model)
    public $phone;
    public $address;
    public $courier = 'jne'; // Default value
    public $paymentMethod = 'bca'; // Default value

    // 2. MOUNT (Jalan sekali pas halaman dibuka)
    // Fungsinya: Isi otomatis No HP & Alamat dari data user yg login
    public function mount()
    {
        $user = Auth::user();
        
        // Cek profile user, kalau ada isinya, kita pake. Kalau ga ada, kosongin.
        $this->phone = $user->profile->phone ?? $user->phone ?? ''; 
        $this->address = $user->profile->address ?? $user->address ?? '';
        
        // Cek kalau keranjang kosong, tendang balik
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
    public function placeOrder()
    {
        $this->validate([
            'phone' => 'required|numeric|digits_between:10,14',
            'address' => 'required|min:10',
            'courier' => 'required|in:jne,jnt,sicepat',
            'paymentMethod' => 'required|in:bca,mandiri,qris',
        ]); // Validation message disingkat biar gak kepanjangan

        $order = DB::transaction(function () {
            
            // 1. Buat Header Order
            $newOrder = Order::create([
                'user_id' => Auth::id(),
                'invoice_number' => 'INV/' . date('Ymd') . '/' . strtoupper(uniqid()),
                'status' => 'pending', 
                'total_price' => $this->grandTotal,
                'shipping_price' => $this->shippingCost,
                'shipping_courier' => $this->courier,
                'shipping_address' => $this->address,
                'recipient_phone' => $this->phone,
                'recipient_name' => Auth::user()->name,
                'payment_method' => $this->paymentMethod,
            ]);

            // 2. Pindahkan Item dari CartItem ke OrderItems
            foreach ($this->cartItems as $item) {
                // Cek stok dulu kalo mau lebih canggih, tapi skip dulu gapapa
                OrderItem::create([
                    'order_id' => $newOrder->id,
                    'product_variant_id' => $item->product_variant_id, // Ambil dari CartItem
                    'quantity' => $item->quantity,
                    'price' => $item->productVariant->price, 
                ]);
            }

            // 3. Hapus Keranjang Belanja (Header Cart)
            // Kalau database kamu setting ON DELETE CASCADE, CartItem otomatis kehapus.
            // Kalau nggak, hapus manual CartItem-nya dulu baru Cart-nya.
            $cart = Cart::where('user_id', Auth::id())->first();
            if($cart) {
                // Opsional: $cart->cartItems()->delete(); 
                $cart->delete(); 
            }

            return $newOrder;
        });

        return redirect()->route('payment.show', ['order' => $order->id]);
    }

    public function render()
    {
        return view('livewire.front.checkout', ['cartItems' => $this->cartItems, 'shippingCost' => $this->shippingCost]);
    }
}