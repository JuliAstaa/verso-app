<div class="container mx-auto px-4 py-8 md:py-12">
    {{-- Breadcrumb simpel --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('pages.product-cart') }}" class="hover:text-brand-600 transition">Cart</a>
        <span>/</span>
        <span class="font-bold text-brand-600">Checkout</span>
    </div>

    <h1 class="text-3xl font-bold mb-8 text-gray-900">Checkout Pengiriman</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12 items-start">
        
        {{-- ========================
             KOLOM KIRI: FORM DATA
             ======================== --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- 1. Card Alamat & Kontak --}}
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm">
                <div class="flex items-center gap-3 mb-6 border-b border-gray-100 pb-4">
                    <div class="w-10 h-10 rounded-full bg-brand-50 flex items-center justify-center text-brand-600">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Informasi Pengiriman</h2>
                        <p class="text-xs text-gray-500">Pastikan alamat dan nomor HP aktif ya.</p>
                    </div>
                </div>

                <div class="space-y-5">
                    {{-- Input No HP --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp / HP <span class="text-red-500">*</span></label>
                        <input wire:model="phone" type="text" 
                               class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all placeholder-gray-400" 
                               placeholder="Contoh: 08123456789">
                        @error('phone') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Input Alamat --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap <span class="text-red-500">*</span></label>
                        <textarea wire:model="address" rows="3" 
                                  class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all placeholder-gray-400" 
                                  placeholder="Nama Jalan, Nomor Rumah, RT/RW, Kecamatan, Kota, Kode Pos..."></textarea>
                        @error('address') <span class="text-xs text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Pilih Kurir --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Kurir <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <select wire:model.live="courier" class="w-full appearance-none bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-brand-500 focus:border-brand-500 transition-all cursor-pointer">
                                <option value="jne">JNE Regular (Rp 15.000)</option>
                                <option value="jnt">J&T Express (Rp 15.000)</option>
                                <option value="sicepat">SiCepat REG (Rp 15.000)</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 2. Review Barang (Biar User Yakin) --}}
            <div class="bg-white p-6 md:p-8 rounded-2xl border border-gray-200 shadow-sm">
                <h2 class="text-lg font-bold mb-6 text-gray-800 border-b border-gray-100 pb-4">Review Pesanan</h2>
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                        @if($item->productVariant) 
        <div class="flex gap-4 items-start">

            {{-- Foto Barang --}}
            <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200 shrink-0">
                {{-- Pake optional() biar ga error kalau gambar kosong --}}
                @if($item->productVariant->product->images->first())
                     <img src="{{ Storage::url($item->productVariant->product->images->first()->image_path) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400">No Img</div>
                @endif
            </div>

            <div class="flex-1">
                <h4 class="text-sm font-bold text-gray-800 leading-tight mb-1">{{ $item->productVariant->product->name }}</h4>
                <div class="flex flex-wrap gap-2 text-xs text-gray-500 mb-1">
                    <span class="bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">{{ $item->productVariant->color->name ?? '-' }}</span>
                    <span class="bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">{{ $item->productVariant->size->name ?? '-' }}</span>
                </div>
            </div>

            <div class="text-right">
                <div class="text-sm font-bold text-gray-800">Rp {{ number_format($item->productVariant->price, 0, ',', '.') }}</div>
                <div class="text-xs text-gray-500">Qty: {{ $item->quantity }}</div>
            </div>
        </div>
        @if(!$loop->last) <hr class="border-dashed border-gray-100"> @endif
    @endif {{-- End IF Variant Check --}}
                    @endforeach
                </div>
            </div>

        </div>

        {{-- ========================
             KOLOM KANAN: RINGKASAN
             ======================== --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-lg lg:sticky lg:top-8">
                <h3 class="text-lg font-bold mb-6 text-gray-800">Ringkasan Belanja</h3>
                
                {{-- Rincian Biaya --}}
                <div class="space-y-3 text-sm mb-6 pb-6 border-b border-dashed border-gray-200">
                    <div class="flex justify-between text-gray-600">
                        <span>Total Harga Barang</span>
                        <span class="font-medium">Rp {{ number_format($this->grandTotal - $shippingCost, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Biaya Pengiriman</span>
                        <span class="font-medium">Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                    </div>
                </div>

                {{-- Grand Total --}}
                <div class="flex justify-between items-end mb-8">
                    <div class="flex flex-col">
                        <span class="text-xs text-gray-500 font-bold uppercase">Total Tagihan</span>
                        <span class="text-xs text-gray-400">(Termasuk Ongkir)</span>
                    </div>
                    <span class="font-bold text-2xl text-brand-600">Rp {{ number_format($this->grandTotal, 0, ',', '.') }}</span>
                </div>

                {{-- TOMBOL BAYAR (PLACE ORDER) --}}
                <button wire:click="placeOrder" 
                        wire:loading.attr="disabled"
                        class="w-full bg-brand-600 hover:bg-brand-700 text-white font-bold py-4 rounded-xl shadow-xl shadow-brand-500/20 transition-all transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2 group">
                    
                    {{-- Text Normal --}}
                    <span wire:loading.remove wire:target="placeOrder" class="flex items-center gap-2">
                        <svg class="w-5 h-5 group-hover:animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                        Bayar Sekarang
                    </span>
                    
                    {{-- Text Loading --}}
                    <span wire:loading wire:target="placeOrder" class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        Memproses Order...
                    </span>
                </button>
                
                <p class="text-center text-[10px] text-gray-400 mt-4 flex justify-center items-center gap-1">
                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    Transaksi aman & terenkripsi
                </p>
            </div>
        </div>

    </div>
</div>