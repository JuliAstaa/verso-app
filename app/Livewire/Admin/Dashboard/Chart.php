<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Chart extends Component
{
    public $labels = [];
    public $data = [];

    public function mount()
    {
        // Ambil data 7 hari terakhir
        $orders = Order::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
        ->where('status', '!=', 'cancelled') // Jangan hitung yang batal
        ->where('status', 'paid')     // Cuma hitung yang udah bayar (opsional)
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->groupBy('date')
        ->orderBy('date', 'ASC')
        ->get();

        // Mapping data biar urut harinya (Kalau hari itu 0 order, tetep muncul)
        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $chartData[$date] = 0; // Default 0
        }

        // Timpa dengan data database
        foreach ($orders as $order) {
            $chartData[$order->date] = $order->total;
        }

        // Pisahkan ke format Chart.js
        foreach ($chartData as $date => $total) {
            $this->labels[] = Carbon::parse($date)->format('d M'); // Format tgl: 15 Jan
            $this->data[] = $total;
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard.chart');
    }
}