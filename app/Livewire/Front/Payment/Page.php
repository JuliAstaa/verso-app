<?php

namespace App\Livewire\Front\Payment;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Page extends Component
{
    public $order;
    public $paymentMethod = 'bca';

    public function mount(Order $order)
    {
        if ($order->user_id !== Auth::id()) abort(403);
        if ($order->payment_status === 'paid') return redirect()->route('customer.orders.index'); // Ganti route sesuai history order kamu
        
        $this->order = $order;
    }

    public function selectMethod($method) { $this->paymentMethod = $method; }

    public function simulatePayment()
    {
        // SIMULASI SUKSES BAYAR
        $this->order->update(['payment_status' => 'paid']);
        
        // Redirect ke history order (atau halaman sukses)
        // Pastikan route 'customer.orders.index' atau semacamnya ada
        return redirect('/')->with('success', 'Pembayaran Berhasil! Barang segera dikirim.'); 
    }

    public function render() { return view('livewire.front.payment.page'); }
}