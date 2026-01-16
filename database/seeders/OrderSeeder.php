<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
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
        $variants = ProductVariant::with('product')->get();

        if($variants->count() == 0) {
            $this->command->error('Gak ada Product Variant! Isi dulu tabel produk & variant woi!');
            return;
        }

        foreach ($customers as $customer) {
            // Kita bikin 2-5 order per customer biar datanya makin kaya
            for ($i = 0; $i < rand(2, 5); $i++) { 
                
                // 1. 🔥 LOGIC TANGGAL RANDOM 🔥
                // Order dibuat acak dalam rentang 3 bulan terakhir sampai detik ini
                $orderDate = $faker->dateTimeBetween('-3 months', 'now');
                
                $status = $faker->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']);

                // 2. Create Kerangka Order
                $order = Order::create([
                    'user_id' => $customer->id,
                    // Invoice number ngikutin tanggal randomnya ($orderDate)
                    'invoice_number' => 'INV/' . $orderDate->format('Ymd') . '/' . strtoupper($faker->bothify('????####')),
                    'status' => $status,
                    'total_price' => 0, // Nanti diupdate di bawah
                    
                    'recipient_name' => $customer->name,
                    'recipient_phone' => $customer->profile->phone ?? $faker->phoneNumber,
                    'shipping_address' => $faker->address,
                    
                    // Tracking number cuma ada kalau barang udah dikirim/selesai
                    'tracking_number' => ($status == 'shipped' || $status == 'completed') ? 'JNE' . $faker->numerify('##########') : null,
                    
                    // 🔥 OVERRIDE TIMESTAMP 🔥
                    'created_at' => $orderDate,
                    'updated_at' => $orderDate, // Anggap update terakhir di waktu yang sama (simplifikasi)
                ]);

                // 3. Isi Item Belanjaan (Random 1-4 jenis barang)
                $grandTotal = 0;
                $randomVariants = $variants->random(rand(1, 4));

                foreach($randomVariants as $variant) {
                    $qty = rand(1, 3);
                    $price = $variant->price; 
                    
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_variant_id' => $variant->id,
                        'quantity' => $qty,
                        'price' => $price,
                        'created_at' => $orderDate, // Itemnya juga harus ikut tanggal order dong
                        'updated_at' => $orderDate,
                    ]);

                    $grandTotal += ($price * $qty);
                }

                // 4. Update Total Harga + Ongkir Dummy
                // Tambahin ongkir random (misal 15rb - 50rb) biar tracking shipping_price enak
                $shippingPrice = rand(15000, 50000);
                
                $order->update([
                    'total_price' => $grandTotal + $shippingPrice,
                ]);
            }
        }
    }
}