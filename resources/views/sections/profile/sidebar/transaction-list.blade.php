{{-- resources/views/sections/profile/transaksi-content.blade.php --}}
<div x-data="{ filter: 'all' }" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 min-h-[500px]">
    <h3 class="text-lg font-bold text-gray-800 mb-6 text-left">Transaction List</h3>

    {{-- Filter & Search Bar --}}
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-8">
        {{-- Search Bar --}}
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </span>
            <input type="text" placeholder="Search your transaction here" class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-2 focus:ring-[#74553d] outline-none transition">
        </div>

        {{-- Status Filter --}}
        <div class="flex items-center gap-2 overflow-x-auto pb-2 md:pb-0">
            <span class="text-sm font-bold text-gray-700 mr-2 whitespace-nowrap">Status:</span>
            
            {{-- Tombol All --}}
            <button 
                @click="filter = 'all'"
                :class="filter === 'all' ? 'bg-brand-500 text-white border-brand-700' : 'border-brand-500 text-brand-500 hover:text-white hover:bg-brand-700'"
                class="px-4 py-1.5 rounded-full text-xs font-bold border transition cursor-pointer whitespace-nowrap">
                All
            </button>

            {{-- Tombol Shipping --}}
            <button 
                @click="filter = 'shipping'"
                :class="filter === 'shipping' ? 'bg-brand-500 text-white border-brand-700' : 'border-brand-500 text-brand-500 hover:text-white hover:bg-brand-700'"
                class="px-4 py-1.5 rounded-full text-xs font-bold border transition cursor-pointer whitespace-nowrap">
                Shipping
            </button>

            {{-- Tombol Completed --}}
            <button 
                @click="filter = 'completed'"
                :class="filter === 'completed' ? 'bg-brand-500 text-white border-brand-700' : 'border-brand-500 text-brand-500 hover:text-white hover:bg-brand-700'"
                class="px-4 py-1.5 rounded-full text-xs font-bold border transition cursor-pointer whitespace-nowrap">
                Completed
            </button>
        </div>
    </div>

    {{-- KONTEN DATA --}}
    <div class="space-y-4">
        @php
            // Simulasi data jika nanti ditarik dari database
            $hasData = isset($transactions) && $transactions->count() > 0;
        @endphp

        @if($hasData)
            @foreach($transactions as $transaction)
                <div 
                    x-show="filter === 'all' || 
                            (filter === 'ongoing' && ['processing', 'shipping', 'pending'].includes('{{ $transaction->status }}')) || 
                            (filter === 'completed' && '{{ $transaction->status }}' === 'completed')"
                    class="p-4 border border-gray-100 rounded-xl hover:shadow-md transition duration-300 bg-white mb-4">
                    
                    {{-- Status Badge --}}
                    <div class="flex justify-between items-center mb-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-4 h-4 text-[#74553d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            <span class="text-xs font-bold text-gray-800 uppercase tracking-tight">Shopping</span>
                            <span class="text-xs text-gray-400">{{ $transaction->created_at->format('d M Y') }}</span>
                        </div>
                        
                        <span class="px-3 py-1 rounded-md text-[10px] font-bold uppercase
                            {{ $transaction->status === 'completed' ? 'bg-green-100 text-green-600' : 'bg-orange-100 text-orange-600' }}">
                            {{ $transaction->status === 'completed' ? 'Completed' : 'On Process' }}
                        </span>
                    </div>

                    {{-- Produk Detail --}}
                    <div class="flex items-center space-x-4">
                        <div class="w-16 h-16 bg-gray-50 rounded-lg flex-shrink-0 overflow-hidden border border-gray-100">
                            <img src="{{ asset('storage/' . $transaction->product->image) }}" class="w-full h-full object-cover" alt="product">
                        </div>
                        <div class="flex-1 text-left">
                            <h4 class="font-bold text-gray-800 text-sm leading-tight">{{ $transaction->product->name }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $transaction->quantity }} item x Rp{{ number_format($transaction->price, 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right border-l pl-4">
                            <p class="text-xs text-gray-400">Total Spend</p>
                            <p class="font-bold text-gray-900 text-sm">Rp{{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="flex justify-end mt-4 pt-4 border-t border-gray-50">
                        <a href="/profile/transaction/{{ $transaction->id }}" class="text-[#74553d] text-xs font-bold hover:underline">
                            View Transaction Detail
                        </a>
                    </div>
                </div>
            @endforeach
        @else
            {{-- EMPTY STATE --}}
            <div class="flex flex-col items-center justify-center py-16 text-center space-y-6">
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

                <a href="/">
                    <x-button variant="solid">Start Shopping</x-button>
                </a>
            </div>
        @endif
    </div>
</div>