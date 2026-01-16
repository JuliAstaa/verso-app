<div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-hidden flex flex-col">
        
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Order Detail</h3>
                <p class="text-xs text-gray-500">{{ $selectedOrder->invoice_number }} • {{ $selectedOrder->created_at->format('d M Y H:i') }}</p>
            </div>
            <button wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
            </button>
        </div>

        {{-- Content (Scrollable) --}}
        <div class="flex-1 overflow-y-auto p-6 bg-gray-50/50">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- KOLOM KIRI: ITEM & ALAMAT --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- List Items --}}
                    <div class="bg-white p-5 rounded-xl border border-gray-200 shadow-sm">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-4">Items Purchased</h4>
                        <div class="space-y-4">
                            @foreach($selectedOrder->orderItems as $item)
                                <div class="flex items-start gap-4">
                                    {{-- Gambar Produk --}}
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg border border-gray-200 overflow-hidden shrink-0">
                                        @if($item->productVariant->product->images->first())
                                             <img src="{{ Storage::url($item->productVariant->product->images->first()->image_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-[10px] text-gray-400">No Img</div>
                                        @endif
                                    </div>
                                    
                                    <div class="flex-1">
                                        <div class="font-bold text-gray-800 text-sm leading-tight mb-1">{{ $item->productVariant->product->name }}</div>
                                        <div class="flex flex-wrap gap-2 text-xs text-gray-500 mb-1">
                                            <span class="bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">Color: {{ $item->productVariant->color->name ?? '-' }}</span>
                                            <span class="bg-gray-100 px-1.5 py-0.5 rounded border border-gray-200">Size: {{ $item->productVariant->size->name ?? '-' }}</span>
                                        </div>
                                        <div class="text-xs font-medium text-brand-600">
                                            {{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    
                                    <div class="font-bold text-gray-800 text-sm">
                                        Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                @if(!$loop->last) <hr class="border-dashed border-gray-100"> @endif
                            @endforeach
                        </div>
                    </div>

                    {{-- Shipping Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Recipient Info</h4>
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-8 h-8 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-xs">
                                    {{ substr($selectedOrder->recipient_name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-bold text-gray-800 text-sm">{{ $selectedOrder->recipient_name }}</p>
                                    <p class="text-xs text-gray-500">{{ $selectedOrder->recipient_phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 bg-white rounded-xl border border-gray-200 shadow-sm">
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Shipping Address</h4>
                            <p class="text-sm text-gray-700 leading-relaxed">{{ $selectedOrder->shipping_address }}</p>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN: ACTION ADMIN (Ini yang ku perbaiki) --}}
                <div class="lg:col-span-1">
                    <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm sticky top-0">
                        <h4 class="text-sm font-bold text-gray-800 mb-4 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                            Admin Action
                        </h4>
                        
                        <form wire:submit.prevent="updateOrder" class="space-y-5">
                            
                            {{-- 1. Status Dropdown --}}
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wide">Update Status</label>
                                <div class="relative">
                                    <select wire:model.live="statusInput" class="w-full appearance-none bg-gray-50 border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block px-4 py-2.5 transition-all">
                                        <option value="pending">⏳ Pending</option>
                                        <option value="paid">💰 Paid (Confirmed)</option>
                                        <option value="shipped">🚚 Shipped (Kirim)</option>
                                        <option value="completed">✅ Completed</option>
                                        <option value="cancelled">❌ Cancelled</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-500">
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- 2. Input Resi --}}
                            @if($statusInput === 'shipped' || $statusInput === 'completed')
                                <div class="animate-fade-in-down">
                                    <label class="block text-xs font-bold text-gray-500 mb-1.5 uppercase tracking-wide">Tracking Number <span class="text-red-500">*</span></label>
                                    <input wire:model="trackingInput" type="text" placeholder="JNE12345678" 
                                           class="w-full bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-brand-500 focus:border-brand-500 block px-4 py-2.5 placeholder-gray-300 uppercase font-medium tracking-wide transition-all shadow-sm">
                                    @error('trackingInput') <span class="text-[10px] text-red-500 font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            @endif

                            {{-- Summary Total --}}
                            <div class="pt-4 border-t border-dashed border-gray-200 mt-2">
                                <div class="flex justify-between items-end">
                                    <span class="text-xs font-bold text-gray-400 uppercase">Grand Total</span>
                                    <span class="text-xl font-bold text-brand-700">Rp {{ number_format($selectedOrder->total_price, 0, ',', '.') }}</span>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <button type="submit" class="w-full bg-brand-500 hover:bg-brand-700 text-white font-bold py-3 rounded-lg transition-all shadow-md shadow-brand-500/20 active:scale-95 flex justify-center items-center gap-2 cursor-pointer">
                                <span wire:target="updateOrder">Save Changes</span>
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>