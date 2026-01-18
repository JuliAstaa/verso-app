<div class="container mx-auto px-4 py-8 md:py-12 bg-[#FAFAFA] min-h-screen font-sans">
    
    {{-- Breadcrumb --}}
    <div class="max-w-7xl mx-auto mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ route('pages.product-cart') }}" class="hover:text-brand-600 transition">Cart</a>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
            <span class="font-bold text-gray-800">Checkout</span>
        </div>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- ====================================================
             LEFT COLUMN (LG:SPAN-8) - ADDRESS & ITEMS
             ==================================================== --}}
        <div class="lg:col-span-8 space-y-6">
            
            {{-- 1. SHIPPING ADDRESS CARD --}}
            <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100 relative overflow-hidden">
                {{-- Brand Accent on Left --}}
                <div class="absolute left-0 top-0 bottom-0 w-1 bg-brand-500"></div>

                <div class="flex justify-between items-start mb-6">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Shipping Address
                    </h3>
                    
                    {{-- Change Button (Visual Only for now) --}}
                    <button class="text-xs font-bold text-brand-600 hover:text-brand-800 flex items-center gap-1 transition-colors px-3 py-1.5 rounded-lg bg-brand-50 hover:bg-brand-100">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                        Change Address
                    </button>
                </div>
                
                {{-- Input Form --}}
                <div class="space-y-4 pl-2">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        {{-- Name & Contact --}}
                        <div class="relative group">
                            <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1 block">Receiver Contact</label>
                            <div class="flex items-center gap-2 border-b border-gray-200 py-2 group-focus-within:border-brand-500 transition-colors">
                                <span class="font-bold text-gray-800 text-sm">{{ $receiverName }}</span>
                                <span class="text-gray-300">|</span>
                                <input wire:model="phone" type="text" class="flex-1 bg-transparent border-none p-0 text-sm focus:outline-0 text-gray-600 placeholder-gray-300" placeholder="Phone Number / WA">
                            </div>
                            @error('phone') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        {{-- Courier Selection --}}
                        <div class="relative group">
                             <label class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1 block">Shipping Service</label>
                            <select wire:model.live="courier" class="w-full bg-gray-50 border-0 border-b border-gray-200 rounded-none px-0 py-2 text-sm focus:ring-0 focus:border-brand-500 transition-colors cursor-pointer text-gray-700 font-medium">
                                <option value="jne">JNE Regular (IDR 15.000)</option>
                                <option value="jnt">J&T Express (IDR 15.000)</option>
                                <option value="sicepat">SiCepat REG (IDR 15.000)</option>
                            </select>
                        </div>
                    </div>

                    {{-- Address Detail --}}
                    <div class="mt-4">
                        <label class="text-[10px] font-bold text-gray-400 uppercase">Address Details</label>
                        <textarea 
                            wire:model="address" 
                            rows="3" 
                            placeholder="Street name, house number, block..."
                            class="w-full border-none p-0 text-sm text-gray-600 focus:ring-0 mt-1 bg-transparent resize-none"></textarea>
                    </div>
                </div>
            </div>

            {{-- 2. ORDER ITEMS CARD --}}
            <div class="bg-white p-6 rounded-xl shadow-[0_2px_10px_-4px_rgba(0,0,0,0.05)] border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                    Your Order
                </h3>

                <div class="divide-y divide-dashed divide-gray-100">
                    @foreach($cartItems as $item)
                        @if($item->productVariant)
                        <div class="flex gap-4 py-4 first:pt-0 last:pb-0">
                            {{-- Image --}}
                            <div class="w-20 h-20 shrink-0 border border-gray-100 rounded-lg overflow-hidden bg-gray-50 relative group">
                                @if($item->productVariant->product->images->first())
                                    <img src="{{ Storage::url($item->productVariant->product->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">No Img</div>
                                @endif
                            </div>

                            {{-- Details --}}
                            <div class="flex-1 flex flex-col justify-between">
                                <div>
                                    <h4 class="font-bold text-gray-800 text-base line-clamp-1">{{ $item->productVariant->product->name }}</h4>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[10px] font-bold text-gray-500 uppercase bg-gray-100 px-2 py-0.5 rounded">{{ $item->productVariant->color->name }}</span>
                                        <span class="text-[10px] font-bold text-gray-500 uppercase bg-gray-100 px-2 py-0.5 rounded">{{ $item->productVariant->size->name }}</span>
                                    </div>
                                </div>
                                <div class="flex justify-between items-end">
                                    <span class="text-sm font-bold text-brand-600">IDR {{ number_format($item->productVariant->price, 0, ',', '.') }}</span>
                                    <span class="text-xs text-gray-500">Qty: {{ $item->quantity }}</span>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ====================================================
             RIGHT COLUMN (LG:SPAN-4) - PAYMENT & SUMMARY
             ==================================================== --}}
        <div class="lg:col-span-4">
            <div class="sticky top-8 space-y-6">

                {{-- PAYMENT METHOD CARD --}}
                <div class="bg-white rounded-xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100 overflow-hidden">
                    <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="font-bold text-gray-800 text-sm">Payment Method</h3>
                        <a href="#" class="text-xs text-brand-600 font-bold hover:underline">View All</a>
                    </div>
                    
                    <div class="p-3 space-y-2">
                        {{-- Option 1: BCA --}}
                        <label class="relative flex items-center justify-between p-3 rounded-xl border cursor-pointer transition-all group
                            {{ $paymentMethod === 'bca' ? 'border-brand-500 bg-brand-50/30 ring-1 ring-brand-500' : 'border-gray-200 hover:border-brand-300 hover:bg-gray-50' }}">
                            
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-7 bg-white border border-gray-200 rounded flex items-center justify-center shadow-sm">
                                    <span class="text-[8px] font-bold text-blue-800 italic">BCA</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-700 font-bold group-hover:text-brand-700">BCA Virtual Account</span>
                                    @if($paymentMethod === 'bca') <span class="text-[10px] text-brand-500 animate-fade-in">Admin Fee IDR 0</span> @endif
                                </div>
                            </div>
                            <div class="relative">
                                <input type="radio" wire:model.live="paymentMethod" value="bca" class="peer sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-gray-300 peer-checked:border-brand-500 peer-checked:bg-brand-500 transition-all"></div>
                            </div>
                        </label>

                        {{-- Option 2: Mandiri --}}
                        <label class="relative flex items-center justify-between p-3 rounded-xl border cursor-pointer transition-all group
                            {{ $paymentMethod === 'mandiri' ? 'border-brand-500 bg-brand-50/30 ring-1 ring-brand-500' : 'border-gray-200 hover:border-brand-300 hover:bg-gray-50' }}">
                            
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-7 bg-white border border-gray-200 rounded flex items-center justify-center shadow-sm">
                                    <span class="text-[8px] font-bold text-blue-900 italic">MANDIRI</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-700 font-bold group-hover:text-brand-700">Mandiri VA</span>
                                </div>
                            </div>
                            <div class="relative">
                                <input type="radio" wire:model.live="paymentMethod" value="mandiri" class="peer sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-gray-300 peer-checked:border-brand-500 peer-checked:bg-brand-500 transition-all"></div>
                            </div>
                        </label>

                        {{-- Option 3: QRIS --}}
                        <label class="relative flex items-center justify-between p-3 rounded-xl border cursor-pointer transition-all group
                            {{ $paymentMethod === 'qris' ? 'border-brand-500 bg-brand-50/30 ring-1 ring-brand-500' : 'border-gray-200 hover:border-brand-300 hover:bg-gray-50' }}">
                            
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-7 bg-white border border-gray-200 rounded flex items-center justify-center shadow-sm">
                                    <span class="text-[8px] font-bold text-gray-800">QRIS</span>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-700 font-bold group-hover:text-brand-700">QRIS (Gopay/OVO)</span>
                                </div>
                            </div>
                            <div class="relative">
                                <input type="radio" wire:model.live="paymentMethod" value="qris" class="peer sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-gray-300 peer-checked:border-brand-500 peer-checked:bg-brand-500 transition-all"></div>
                            </div>
                        </label>
                    </div>

                    {{-- Promo Section --}}
                    <div class="px-3 pb-3">
                        <button class="w-full py-2.5 border border-dashed border-brand-300 bg-brand-50 text-brand-700 text-xs font-bold rounded-lg flex items-center justify-between px-3 hover:bg-brand-100 transition group">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-brand-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                Save more with promo
                            </span>
                            <svg class="w-3 h-3 text-brand-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                </div>

                {{-- SHOPPING SUMMARY CARD --}}
                <div class="bg-white p-6 rounded-xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.1)] border border-gray-100">
                    <h3 class="font-bold text-gray-800 text-sm mb-4">Shopping Summary</h3>

                    <div class="space-y-3 text-sm text-gray-600 mb-6">
                        <div class="flex justify-between">
                            <span>Total Price ({{ count($cartItems) }} Items)</span>
                            <span class="font-medium">IDR {{ number_format($this->grandTotal - $shippingCost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Total Shipping Cost</span>
                            <span class="font-medium">IDR {{ number_format($shippingCost, 0, ',', '.') }}</span>
                        </div>
                         {{-- Discount section can be added here later --}}
                        <div class="flex justify-between text-brand-600">
                            <span>Item Discount</span>
                            <span class="font-medium">- IDR 0</span>
                        </div>
                        
                        <div class="border-t border-dashed border-gray-200 pt-4 mt-2 flex justify-between items-center">
                            <div class="flex flex-col">
                                <span class="font-bold text-gray-800 text-base">Total Bill</span>
                                <span class="text-[10px] text-gray-400">Includes VAT if applicable</span>
                            </div>
                            <span class="font-bold text-xl text-brand-600">IDR {{ number_format($this->grandTotal, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <x-btn-loading 
                        action="placeOrder()" 
                        loadingText="Processing..." 
                        class="w-full bg-brand-500 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-brand-600/30 transition-all transform hover:-translate-y-0.5 active:scale-95 flex justify-center items-center gap-2"
                        :disabled="($currentVariant->stock ?? 0) <= 0"
                    >
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-brand-100" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Pay Now
                        </span>
                        
                    </x-btn-loading>

                    <p class="text-[10px] text-gray-400 mt-4 text-center leading-tight">
                        By continuing payment, you agree to our <a href="#" class="text-brand-600 underline font-bold">Terms & Conditions</a>.
                    </p>
                </div>

            </div>
        </div>

    </div>
</div>