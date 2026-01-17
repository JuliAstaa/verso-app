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

        // Ambil Data Master
        // Kita ambil ID-nya aja biar enteng pas random pick
        $customerIds = User::where('role', 'customer')->pluck('id');
        $variants = ProductVariant::with('product')->get();

        // Validasi Dulu
        if($variants->count() == 0) {
            $this->command->error('❌ Gak ada Product Variant! Isi dulu tabel produk & variant woi!');
            return;
        }

        if($customerIds->count() == 0) {
            $this->command->error('❌ Gak ada Customer! Bikin user role customer dulu!');
            return;
        }

        $this->command->info('🚀 Mulai mencetak 1.000 Order Masa Depan...');

        // 🔥 LOOPING 1000 KALI 🔥
        for ($i = 0; $i < 1000; $i++) { 
            
            // 1. Pilih Customer Acak
            $customerId = $customerIds->random();
            $customer = User::find($customerId); // Ambil datanya buat nama & hp

            // 2. 🔥 LOGIC TANGGAL MASA DEPAN 🔥
            // Dari detik ini sampai 1 tahun ke depan
            $orderDate = $faker->dateTimeBetween('now', '+1 year');
            
            $status = $faker->randomElement(['pending', 'paid', 'shipped', 'completed', 'cancelled']);

            // 3. Create Kerangka Order
            $order = Order::create([
                'user_id' => $customerId,
                'invoice_number' => 'INV/' . $orderDate->format('Ymd') . '/' . strtoupper($faker->bothify('????####')),
                'status' => $status,
                'total_price' => 0, // Nanti diupdate
                
                'recipient_name' => $customer->name,
                'recipient_phone' => $customer->profile->phone ?? $faker->phoneNumber,
                'shipping_address' => $faker->address,
                
                // Tracking number cuma kalau udah dikirim
                'tracking_number' => ($status == 'shipped' || $status == 'completed') ? 'JNE' . $faker->numerify('##########') : null,
                
                // 🔥 PAKSA TANGGALNYA JADI MASA DEPAN 🔥
                'created_at' => $orderDate,
                'updated_at' => $orderDate, 
            ]);

            // 4. Isi Item Belanjaan (Random 1-5 jenis barang)
            $grandTotal = 0;
            $randomVariants = $variants->random(rand(1, 5));

            foreach($randomVariants as $variant) {
                $qty = rand(1, 3);
                $price = $variant->price; 
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_variant_id' => $variant->id,
                    'quantity' => $qty,
                    'price' => $price,
                    'created_at' => $orderDate, // Item ikut tanggal order
                    'updated_at' => $orderDate,
                ]);

                $grandTotal += ($price * $qty);
            }

            // 5. Update Total + Ongkir
            $shippingPrice = rand(15000, 50000);
            
            $order->update([
                'total_price' => $grandTotal + $shippingPrice,
            ]);

            // Progress bar biar gak bengong nungguinnya
            if (($i + 1) % 100 == 0) {
                $this->command->info("✅ Berhasil membuat " . ($i + 1) . " order...");
            }
        }

        $this->command->info('🎉 SELESAI! 1.000 Order dari masa depan berhasil didatangkan!');
    }
}