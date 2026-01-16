<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 text-gray-500 font-bold border-b border-gray-100">
        <tr>
            <th class="px-4 py-3">Invoice Info</th>
            <th class="px-4 py-3">Customer</th>
            <th class="px-4 py-3">Total Amount</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3 text-center">Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @forelse($orders as $order)
            <tr class="hover:bg-gray-50 transition group">
                
                {{-- 1. Invoice & Date --}}
                <td class="px-4 py-3">
                    <div class="flex flex-col">
                        <span class="font-bold text-gray-800 text-xs">{{ $order->invoice_number }}</span>
                        <span class="text-[10px] text-gray-400">{{ $order->created_at->format('d M Y H:i') }}</span>
                    </div>
                </td>

                {{-- 2. Customer Info --}}
                <td class="px-4 py-3">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full bg-brand-100 text-brand-600 flex items-center justify-center text-[10px] font-bold">
                            {{ substr($order->recipient_name, 0, 1) }}
                        </div>
                        <div class="flex flex-col">
                            <span class="text-xs font-bold text-gray-700">{{ $order->recipient_name }}</span>
                            <span class="text-[10px] text-gray-400">{{ $order->recipient_phone }}</span>
                        </div>
                    </div>
                </td>

                {{-- 3. Total Price --}}
                <td class="px-4 py-3">
                    <span class="font-mono font-bold text-gray-700">
                        Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </span>
                    <div class="text-[10px] text-gray-400">{{ $order->orderItems->count() }} Items</div>
                </td>

                {{-- 4. Status Badge (Logic Warna) --}}
                <td class="px-4 py-3">
                    @php
                        $statusClasses = [
                            'pending'   => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                            'paid'      => 'bg-blue-50 text-blue-700 border-blue-200',
                            'shipped'   => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                            'completed' => 'bg-green-50 text-green-700 border-green-200',
                            'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                        ];
                        $currentClass = $statusClasses[$order->status] ?? 'bg-gray-50 text-gray-600';
                    @endphp

                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold border {{ $currentClass }} uppercase tracking-wider">
                        {{ $order->status }}
                    </span>
                    
                    {{-- Kalau ada resi, tampilin kecil dibawahnya --}}
                    @if($order->tracking_number)
                        <div class="mt-1 flex items-center gap-1 text-[10px] text-gray-500">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $order->tracking_number }}
                        </div>
                    @endif
                </td>

                {{-- 5. Action --}}
                <td class="px-4 py-3 text-center">
                    {{-- Tombol Detail (Nanti kita bikin modal/halamannya) --}}
                    <button wire:click="showDetail({{ $order->id }})" 
                            class="text-gray-400 hover:text-brand-600 transition cursor-pointer p-1 rounded hover:bg-brand-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="px-6 py-12 text-center text-gray-400 border-2 border-dashed border-gray-100 rounded-xl bg-gray-50 mt-4">
                    <div class="flex flex-col items-center justify-center">
                        <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                        <p class="font-bold">Belum ada transaksi</p>
                        <p class="text-xs">Coba ubah filter atau tunggu orderan masuk.</p>
                    </div>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>