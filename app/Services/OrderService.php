<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderService
{
    public function createOrder($user, $data, $cartItems)
    {
        return DB::transaction(function () use ($user, $data, $cartItems) {
            
            // 1. BIKIN HEADER ORDER
            $order = Order::create([
                'user_id'          => $user->id,
                'invoice_number'   => 'INV/' . date('Ymd') . '/' . strtoupper(Str::random(5)),
                'status'           => 'pending',
                'payment_status'   => 'unpaid',
                'recipient_name'   => $user->name,
                'recipient_phone'  => $data['recipient_phone'],
                'shipping_address' => $data['address'],
                'shipping_courier' => $data['courier'],
                'shipping_cost'    => $data['shipping_cost'],
                'total_price'      => 0, // Update nanti
            ]);

            $grandTotal = 0;

            // 2. PINDAHIN CART -> ORDER ITEMS
            foreach ($cartItems as $item) {
                // Harga ambil dari variant saat ini
                $price = $item->productVariant->price; 
                $subtotal = $item->quantity * $price;

                OrderItem::create([
                    'order_id'           => $order->id,
                    'product_variant_id' => $item->product_variant_id,
                    'quantity'           => $item->quantity,
                    'price'              => $price,
                ]);

                $grandTotal += $subtotal;
            }

            // 3. UPDATE TOTAL & BERSIHKAN KERANJANG
            $order->update([
                'total_price' => $grandTotal + $data['shipping_cost']
            ]);

            // Hapus isi keranjang user ini
            CartItem::where('cart_id', $cartItems->first()->cart_id)->delete();

            return $order;
        });
    }
}