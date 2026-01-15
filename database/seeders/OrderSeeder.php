<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant; // Pastikan model ini ada
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil Customer & Variant Barang
        $customers = User::where('role', 'customer')->get();
        $variants = ProductVariant::with('product')->get(); // Load variant beserta produknya

        if($variants->count() == 0) {
            $this->command->error('Gak ada Product Variant! Isi dulu tabel produk & variant woi!');
            return;
        }

        foreach ($customers as $customer) {
            // Kita bikin 1-3 order per customer biar rame
            for ($i = 0; $i < rand(1, 3); $i++) {
                
                $status = $faker->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']);

                // 1. Create Kerangka Order
                $order = Order::create([
                    'user_id' => $customer->id,
                    'invoice_number' => 'INV/' . date('Ymd') . '/' . strtoupper($faker->bothify('????####')),
                    'status' => $status,
                    'total_price' => 0, // Nanti diupdate
                    'recipient_name' => $customer->name, // Atau nama acak: $faker->name
                    'recipient_phone' => $customer->profile->phone ?? $faker->phoneNumber,
                    'shipping_address' => $faker->address,
                    'tracking_number' => ($status == 'shipped' || $status == 'completed') ? 'JNE' . $faker->numerify('##########') : null,
                ]);

                // 2. Isi Item Belanjaan (Random 1-5 jenis barang)
                $grandTotal = 0;
                
                // Ambil 1-4 variant acak
                $randomVariants = $variants->random(rand(1, 4));

                foreach($randomVariants as $variant) {
                    $qty = rand(1, 3);
                    $price = $variant->price; // Harga saat beli
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
                        'quantity' => $qty,
                        'price' => $price,
                    ]);

                    $grandTotal += ($price * $qty);
                }

                // 3. Update Total Harga Order
                $order->update(['total_price' => $grandTotal]);
            }
        }
    }
}