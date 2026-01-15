<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 min-h-[500px]">
    <h3 class="text-lg font-bold text-gray-800 mb-6 border-b pb-4">Menunggu Pembayaran</h3>

    {{-- CEK APAKAH ADA DATA BARANG --}}
    @if(isset($pendingOrders) && $pendingOrders->count() > 0)
        
        <div class="space-y-4">
            @foreach($pendingOrders as $item)
                <div class="flex flex-col md:flex-row items-center justify-between p-4 border rounded-2xl hover:border-orange-200 transition">
                    <div class="flex items-center space-x-4 w-full">
                        {{-- Foto Barang --}}
                        <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $item->product->image) }}" class="w-full h-full object-cover" alt="Produk">
                        </div>
                        
                        <div class="flex-1 text-left">
                            <p class="text-[10px] font-bold text-orange-500 uppercase tracking-widest">{{ $item->status_pembayaran }}</p>
                            <h4 class="font-bold text-gray-800 leading-tight">{{ $item->product->name }}</h4>
                            <p class="text-xs text-gray-500 mt-1">{{ $item->quantity }} Barang x Rp{{ number_format($item->price) }}</p>
                            <p class="text-sm font-bold text-gray-900 mt-2">Total: Rp{{ number_format($item->total_amount) }}</p>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-0 w-full md:w-auto flex gap-2">
                        <a href="/checkout/pay/{{ $item->id }}" class="flex-1 md:flex-none text-center px-6 py-2 bg-[#74553d] text-white text-xs font-bold rounded-lg hover:bg-[#5a4230] transition">
                            Bayar Sekarang
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        {{-- TAMPILAN KALO KOSONG (Kodingan yang tadi) --}}
        <div class="flex flex-col items-center justify-center py-20 text-center space-y-6">
            <div class="space-y-2">
                <h3 class="text-xl font-bold text-gray-800">Belum ada transaksi</h3>
                <p class="text-sm text-gray-500 leading-relaxed">Yuk, mulai belanja di Verso.</p>
            </div>
            <a href="/">
                <x-button variant="solid">Mulai Belanja</x-button>
            </a>
        </div>
    @endif
</div>