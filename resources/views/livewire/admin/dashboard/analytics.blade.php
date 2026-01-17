<div class="space-y-6">
    
    {{-- BAGIAN 1: KPI CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        {{-- Card 1: Revenue --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Revenue</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                </div>
                <div class="p-2 bg-green-50 rounded-lg text-green-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs">
                @if($revenueGrowth >= 0)
                    <span class="text-green-600 font-bold flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                        {{ $revenueGrowth }}%
                    </span>
                    <span class="text-gray-400 ml-2">vs last month</span>
                @else
                    <span class="text-red-500 font-bold flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" /></svg>
                        {{ $revenueGrowth }}%
                    </span>
                    <span class="text-gray-400 ml-2">vs last month</span>
                @endif
            </div>
        </div>

        {{-- Card 2: Customers --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Customers</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalCustomers) }}</h3>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 flex items-center text-xs">
                <span class="text-{{ $customerGrowth >= 0 ? 'green' : 'red' }}-600 font-bold">
                    {{ $customerGrowth >= 0 ? '+' : '' }}{{ $customerGrowth }}%
                </span>
                <span class="text-gray-400 ml-2">vs last month</span>
            </div>
        </div>
        

        {{-- Card 3: Orders --}}
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Orders</p>
                    <h3 class="text-2xl font-bold text-gray-800 mt-2">{{ number_format($totalOrders) }}</h3>
                </div>
                <div class="p-2 bg-brand-50 rounded-lg text-brand-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                </div>
            </div>
             <div class="mt-4 flex items-center text-xs">
                <span class="text-{{ $orderGrowth >= 0 ? 'green' : 'red' }}-600 font-bold">
                    {{ $orderGrowth >= 0 ? '+' : '' }}{{ $orderGrowth }}%
                </span>
                <span class="text-gray-400 ml-2">vs last month</span>
            </div>
        </div>

    </div>

    {{-- BAGIAN 2: GRAFIK & TOP PRODUCTS --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- GRAFIK PENDAPATAN (Ambil dari component Chart sebelumnya) --}}
        <div class="lg:col-span-2 h-full">
            @livewire('admin.dashboard.chart') {{-- Panggil Component Chart yg udh dibuat --}}
        </div>

        {{-- TOP SELLING PRODUCTS --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm h-full">
            <h3 class="font-bold text-gray-800 mb-4 border-b pb-2">Top Products 🔥</h3>
            
            <div class="space-y-4">
                @forelse($topProducts as $item)
                <div class="flex items-center gap-3">
                    {{-- Image --}}
                    <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden shrink-0 border border-gray-200">
                           
                        @if($item->productVariant?->product?->images?->first())
                                <img src="{{ Storage::url($item->productVariant?->product?->images?->first()->image_path) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400">No Img</div>
                            @endif 
                        </div>
                        
                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold text-gray-800 truncate">{{ $item->productVariant?->product?->name ?? 'Produk Dihapus' }}</h4>
                            <p class="text-xs text-gray-500">
                                {{ $item->productVariant->color->name ?? '-' }}, {{ $item->productVariant->size->name ?? '-' }}
                            </p>
                        </div>
                        
                        {{-- Sold Count --}}
                        <div class="text-right">
                            <span class="block font-bold text-brand-600">{{ $item->total_sold }} Sold</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400 text-xs">
                        Belum ada penjualan.
                    </div>
                @endforelse
            </div>

            {{-- Button View All --}}
            <div class="mt-6 pt-4 border-t border-gray-50 text-center">
                <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-brand-500 hover:text-brand-700 transition">View All Orders &rarr;</a>
            </div>
        </div>

    </div>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-10">
        
        {{-- TABEL RECENT ORDERS (Ambil 2/3 Layar) --}}
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800">Recent Transactions 💳</h3>
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-brand-600 font-bold hover:underline">View All</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-400 uppercase bg-gray-50/50">
                        <tr>
                            <th class="px-4 py-3 rounded-l-lg">Invoice</th>
                            <th class="px-4 py-3">Customer</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 rounded-r-lg text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($recentOrders as $order)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $order->invoice_number }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center text-[10px] font-bold">
                                            {{ substr($order->recipient_name, 0, 1) }}
                                        </div>
                                        <span class="text-gray-600 text-xs">{{ $order->recipient_name }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 font-bold text-gray-700">Rp {{ number_format($order->total_price/1000, 0) }}k</td>
                                <td class="px-4 py-3">
                                    @php
                                        $colors = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'paid' => 'bg-blue-100 text-blue-700',
                                            'shipped' => 'bg-indigo-100 text-indigo-700',
                                            'completed' => 'bg-green-100 text-green-700',
                                            'cancelled' => 'bg-red-100 text-red-700',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 rounded text-[10px] font-bold uppercase {{ $colors[$order->status] ?? 'bg-gray-100' }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    {{-- Link ke Detail Modal (Kalau mau implementasi showDetail di parent) --}}
                                    <button class="text-gray-400 hover:text-brand-600">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4 text-gray-400">Sepi bos...</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- DONUT CHART STATUS (Ambil 1/3 Layar) --}}
        <div class="lg:col-span-1 bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex flex-col">
            <h3 class="font-bold text-gray-800 mb-6">Order Status 📊</h3>
            
            <div class="relative flex-1 flex items-center justify-center min-h-[200px]" wire:ignore>
                <canvas id="statusChart"></canvas>
            </div>

            {{-- Legend Manual (Opsional biar rapi) --}}
            <div class="mt-6 grid grid-cols-2 gap-2 text-xs text-gray-500">
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-yellow-400"></span> Pending</div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-blue-400"></span> Paid</div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-indigo-400"></span> Shipped</div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-green-400"></span> Completed</div>
            </div>
        </div>

    </div>

</div> {{-- End div utama --}}

{{-- SCRIPT KHUSUS DONUT CHART --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxStatus = document.getElementById('statusChart').getContext('2d');
        
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: ['Pending', 'Paid', 'Shipped', 'Completed', 'Cancelled'],
                datasets: [{
                    data: @json($statusCounts),
                    backgroundColor: [
                        '#FBBF24', // Yellow (Pending)
                        '#60A5FA', // Blue (Paid)
                        '#818CF8', // Indigo (Shipped)
                        '#34D399', // Green (Completed)
                        '#F87171'  // Red (Cancelled)
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%', // Biar bolong tengahnya gede (Donut style)
                plugins: {
                    legend: {
                        display: false // Kita pake legend manual aja di HTML biar rapi
                    }
                }
            }
        });
    });
</script>

</div>
