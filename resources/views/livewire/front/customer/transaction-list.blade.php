<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden font-poppins min-h-[600px] p-8">

    {{-- 1. TITLE --}}
    <div class="mb-6">
        <h3 class="text-lg font-bold text-gray-800">Transaction List</h3>
    </div>

    {{-- 2. FILTERS (Search & Status) --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-8">
        
        {{-- Search Bar --}}
        <div class="relative w-full md:w-1/2">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            {{-- Pake wire:model.live biar realtime search ke backend --}}
            <input wire:model.live.debounce.300ms="search" 
                   type="text" 
                   placeholder="Search invoice number..." 
                   class="w-full pl-10 pr-4 py-2.5 bg-white border border-gray-200 rounded-lg text-sm focus:ring-1 focus:ring-[#74553d] focus:border-[#74553d] outline-none transition placeholder-gray-400">
        </div>

        {{-- Status Filter --}}
        <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-2 md:pb-0">
            <span class="text-sm font-bold text-gray-700 mr-2 whitespace-nowrap">Status:</span>
            
            @php
                $statuses = [
                    'all' => 'All',
                    'pending' => 'Pending', 
                    'paid' => 'Paid',
                    'shipped' => 'Shipping', // Di DB 'shipped', di UI 'Shipping'
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled'
                ];
            @endphp

            @foreach($statuses as $key => $label)
                <button 
                    wire:click="setStatus('{{ $key }}')"
                    class="px-4 py-1.5 rounded-full text-xs font-bold border transition cursor-pointer whitespace-nowrap
                    {{ $status === $key 
                        ? 'bg-[#74553d] text-white border-[#74553d]' 
                        : 'border-gray-200 text-gray-500 hover:border-[#74553d] hover:text-[#74553d]' 
                    }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    {{-- 3. CONTENT AREA --}}
   
    <div class="space-y-4">
        @forelse($transactions as $transaction)
            <div class="p-5 border border-gray-200 rounded-xl hover:border-[#74553d]/30 hover:shadow-md transition duration-300 bg-white group">
                @php
                    $firstItem = $transaction->orderItems->first();
                @endphp
                {{-- Header Card: Invoice & Status --}}
                <div class="flex justify-between items-center mb-4 pb-4 border-b border-gray-50">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-gray-50 rounded-lg text-[#74553d]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 text-sm">{{ $transaction->invoice_number }}</h4>
                            <span class="text-xs text-gray-400">{{ $transaction->created_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                    
                    {{-- Dynamic Badge Color --}}
                    @php
                        $badgeColor = match($transaction->status) {
                            'completed' => 'bg-green-100 text-green-600',
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'paid' => 'bg-blue-100 text-blue-600',
                            'shipped' => 'bg-orange-100 text-orange-600',
                            'cancelled' => 'bg-red-100 text-red-600',
                            default => 'bg-gray-100 text-gray-600',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wide {{ $badgeColor }}">
                        {{ $transaction->status }}
                    </span>
                </div>

                {{-- Body Card: Order Info --}}
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    {{-- Info Barang (Kita ambil item pertama sebagai preview) --}}
                    <div class="flex items-center gap-4 w-full md:w-auto">
                        <div class="w-12 h-12 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-100 overflow-hidden">
                    @if($firstItem?->productVariant?->product?->image)
                        <img src="{{ Storage::url($firstItem->productVariant->product->image) }}" class="w-full h-full object-cover">
                    @else
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    @endif
                        </div>
                        
                        <div>
                            @if($firstItem)
                                {{-- 🔥 INI CARA PANGGIL NAMANYA: OrderItem -> Variant -> Product --}}
                                <p class="text-sm font-bold text-gray-800">
                                    {{ $firstItem->productVariant->product->name ?? 'Product Unavailable' }}
                                </p>

                                {{-- Nama Varian (Contoh: Merah, XL) --}}
                                <p class="text-[10px] text-gray-400 font-medium uppercase">
                                    {{ $firstItem->productVariant->name ?? '' }}
                                </p>

                                {{-- Info sisa item lainnya --}}
                                @if($transaction->orderItems->count() > 1)
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        + {{ $transaction->orderItems->count() - 1 }} other items
                                    </p>
                                @endif
                            @else
                                <p class="text-sm font-bold text-gray-800">Order Items</p>
                                <p class="text-xs text-gray-500">No details available</p>
                            @endif
                        </div>
                        
                    </div>

                    {{-- Total Amount --}}
                    <div class="text-right w-full md:w-auto">
                        <p class="text-xs text-gray-400 mb-0.5">Total Amount</p>
                        <p class="font-bold text-gray-900 text-base">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    </div>
                </div>

                {{-- Footer: Action --}}
                <div class="mt-4 pt-4 border-t border-gray-50 flex justify-end">
                    {{-- Link ke Detail --}}
                    <a href="#" class="text-[#74553d] text-xs font-bold hover:underline flex items-center gap-1">
                        View Transaction Detail
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </a>
                </div>
            </div>

        @empty
            {{-- EMPTY STATE (Design Kamu) --}}
            <div class="flex flex-col items-center justify-center py-16 text-center space-y-6 animate-fade-in-up">
                <div class="w-40 h-40 bg-gray-50 rounded-xl flex items-center justify-center border-2 border-dashed border-gray-200">
                    <svg class="w-20 h-20 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>

                <div class="space-y-2">
                    <h3 class="text-xl font-bold text-gray-800">No transactions yet</h3>
                    <p class="text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                        Let's start shopping and fulfill your needs at Verso.
                    </p>
                </div>

                <a href="{{ route('dashboard') }}">
                    <x-button variant="solid" class="!rounded-xl shadow-lg shadow-[#74553d]/20">Start Shopping</x-button>
                </a>
            </div>
        @endforelse
    </div>
    
    {{-- Pagination --}}
    <div class="mt-8">
        {{ $transactions->links() }}
    </div>
</div>