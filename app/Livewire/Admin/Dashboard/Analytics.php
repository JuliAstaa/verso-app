<?php

namespace App\Livewire\Admin\Dashboard;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Analytics extends Component
{
    public $totalRevenue, $revenueGrowth;
    public $totalCustomers, $customerGrowth;
    public $totalOrders, $orderGrowth;
    
    public $topProducts = [];
    public $recentOrders = [];
    public $statusCounts = [];

    public function mount()
    {
        // 1. HITUNG REVENUE (PENDAPATAN)
        $thisMonthRevenue = Order::where('status', 'paid')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_price');

        $lastMonthRevenue = Order::where('status', 'paid')
            ->whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->sum('total_price');

        $this->totalRevenue = $thisMonthRevenue;
        $this->revenueGrowth = $this->calculateGrowth($thisMonthRevenue, $lastMonthRevenue);

        // 2. HITUNG CUSTOMERS
        $thisMonthCust = User::where('role', 'customer')->whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonthCust = User::where('role', 'customer')->whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
        
        $this->totalCustomers = User::where('role', 'customer')->count(); // Total semua
        $this->customerGrowth = $this->calculateGrowth($thisMonthCust, $lastMonthCust);

        // 3. HITUNG ORDERS
        $thisMonthOrder = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $lastMonthOrder = Order::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();

        $this->totalOrders = Order::count();
        $this->orderGrowth = $this->calculateGrowth($thisMonthOrder, $lastMonthOrder);

        // 4. TOP 5 BEST SELLING PRODUCTS
        $this->topProducts = OrderItem::select('product_variant_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_variant_id')
            ->orderByDesc('total_sold')
            ->with('productVariant.product', 'productVariant.color', 'productVariant.size')
            ->take(5)
            ->get();
        
        // 5. RECENT ORDERS (Buat Tabel Bawah)
        $this->recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // 6. ORDER STATUS DISTRIBUTION (Buat Donut Chart)
        // Urutan: Pending, Paid, Shipped, Completed, Cancelled
        $this->statusCounts = [
            Order::where('status', 'pending')->count(),
            Order::where('status', 'paid')->count(),
            Order::where('status', 'shipped')->count(),
            Order::where('status', 'completed')->count(),
            Order::where('status', 'cancelled')->count(),
        ];
    }

    // Helper buat hitung persentase kenaikan/penurunan
    private function calculateGrowth($current, $previous)
    {
        if ($previous == 0) return 100; // Kalau bulan lalu 0, berarti naik 100%
        return round((($current - $previous) / $previous) * 100, 1);
    }

    public function render()
    {
        return view('livewire.admin.dashboard.analytics');
    }
}