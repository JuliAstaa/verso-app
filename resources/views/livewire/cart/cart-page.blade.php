<div class="container mx-auto p-4 md:p-6">
    <h1 class="text-2xl font-bold mb-4 text-gray-800">Your Cart</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
        <div class="lg:col-span-2 space-y-6 w-full flex flex-col">
            
            @if(!$this->items->isEmpty())
                <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <input type="checkbox" 
                               wire:model.live="selectAll"
                               class="w-5 h-5 rounded border-gray-300 text-brand-500 focus:ring-brand-700 cursor-pointer">
                        <span class="font-medium text-gray-700">Select All ({{ count($selectedItems) }})</span>
                    </div>
                    
                    @if(count($selectedItems) > 0)
                        <button wire:click="removeSelected" 
                                class="text-brand-500 font-bold text-sm hover:underline transition">
                            Remove
                        </button>
                    @endif
                </div>

                <pre class="text-[10px]">Selected IDs: {{ json_encode($selectedItems) }}</pre>

                <section class="space-y-4">
                    @foreach($this->items as $item)
                        <div wire:key="cart-item-{{ $item->id }}" 
                             class="bg-white p-4 rounded-xl border shadow-sm flex flex-col gap-4 transition-all {{ in_array((string)$item->id, $selectedItems) ? 'border-[#6B4F3B]/30 bg-[#6B4F3B]/5' : 'border-gray-100' }}">
                            
                            <div class="flex gap-4">
                                <div class="flex items-start pt-2">
                                    <input type="checkbox" 
                                           value="{{ $item->id }}"
                                           wire:model.live="selectedItems"
                                           wire:key="checkbox-{{ $item->id }}"
                                           class="w-5 h-5 rounded border-gray-300 text-brand-500 focus:ring-brand-500 cursor-pointer">
                                </div>

                                <div class="w-20 h-20 flex-shrink-0 bg-gray-50 rounded-lg overflow-hidden border border-gray-100">
                                    @if($item->productVariant->image_url)
                                        <img src="{{ asset($item->productVariant->image_url) }}" 
                                             class="w-full h-full object-cover"
                                             alt="{{ $item->productVariant->name }}"
                                             onerror="this.src='https://via.placeholder.com/100?text=No+Image'">
                                    @else
                                        <img src="https://via.placeholder.com/100?text=No+Image" class="w-full h-full object-cover opacity-50">
                                    @endif
                                </div>

                                <div class="flex-grow">
                                    <h3 class="text-sm font-semibold text-gray-700 leading-tight line-clamp-2 mb-1">{{ $item->productvariant->name }}</h3>
                                    <p class="font-bold text-brand-500 mt-1">IDR {{ number_format($item->price, 0, ',', '.') }}</p>
                                </div>
                            </div>

                            <div class="flex justify-end items-center gap-6 mt-1">
                                <div class="flex items-center gap-4 text-gray-400">
                                    <button class="hover:text-red-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    </button>
                                    <button wire:click="removeItem({{ $item->id }})" 
                                            class="hover:text-red-500 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </div>

                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden h-8 bg-white">
                                    <button wire:click="decrementQty({{ $item->id }})" class="px-3 py-1 bg-gray-50 hover:bg-gray-100 transition text-gray-600 border-r">-</button>
                                    <span class="px-4 text-sm font-medium text-gray-700">{{ $item->quantity }}</span>
                                    <button wire:click="incrementQty({{ $item->id }})" class="px-3 py-1 bg-gray-50 hover:bg-gray-100 transition text-[#6B4F3B] border-l">+</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </section>
            @else
                <div class="bg-white p-8 md:p-12 rounded-2xl border border-gray-100 shadow-sm flex flex-col md:flex-row items-center justify-center gap-8 text-center md:text-left">
                    <img src="{{ asset('images/cart/cartEmpty.svg') }}" alt="Empty Cart" class="w-40 md:w-48">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Your cart is empty</h2>
                        <p class="text-gray-500 mb-6">Want something? Add it to your cart now!</p>
                        <a href="/">
                            <x-button variant="solid" class="rounded-md">Start Shopping</x-button>
                        </a>
                    </div>
                </div>
            @endif

            <section wire:ignore class="my-10">
                <h2 class="text-xl font-bold mb-6 w-fit border-b-2 border-brand-500 pb-1">Product Recommendations</h2>
                <div class="w-full">
                    <livewire:product.product-list :showLoadMore="false" :limit="16" :columns="4" wire:key="recommendations-grid"/>
                </div>
            </section>
        </div>

        <div class="lg:sticky lg:top-47 w-full"> 
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                <h2 class="text-lg font-bold mb-4 text-gray-800 border-b pb-2">Shopping summary</h2>
                
                <div class="flex justify-between items-center mb-6">
                    <span class="text-gray-500">Total Price</span>
                    <span class="text-xl font-bold text-gray-800">
                        {{ count($selectedItems) > 0 ? 'IDR ' . number_format($this->totalPrice, 0, ',', '.') : '-' }}
                    </span>
                </div>

                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl border border-gray-200 mb-6 cursor-pointer hover:bg-gray-100 transition group">
                    <div class="flex items-center gap-2 text-sm text-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-brand-500">
                            <path d="M2 9a3 3 0 1 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 1 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"/><path d="M9 9h.01"/><path d="m15 9-6 6"/><path d="M15 15h.01"/>
                        </svg>
                        <span class="font-medium text-gray-700">Makin hemat pakai promo</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </div>

                <button 
                    @disabled(empty($selectedItems))
                    class="w-full py-3 rounded-xl font-bold text-lg transition-all duration-300 shadow-md 
                    {{ empty($selectedItems) 
                        ? 'bg-gray-100 text-gray-400 cursor-not-allowed' 
                        : 'bg-brand-500 text-white hover:bg-brand-700' 
                    }}"
                >
                    Buy ({{ $this->totalSelectedQty }})
                </button>
            </div>
        </div>
    </div>
</div>