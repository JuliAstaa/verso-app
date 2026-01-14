<div id="product-list-container"> {{-- GUNAKAN ID STATIS --}}
    @php
        $gridClasses = [
            4 => 'lg:grid-cols-4',
            6 => 'lg:grid-cols-6',
        ];
        $currentGrid = $gridClasses[$columns] ?? 'lg:grid-cols-6';
    @endphp

    {{-- Grid Wrapper --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 {{ $currentGrid }} gap-4 w-full">
        @foreach($products as $product)
            {{-- Card Item --}}
            <div 
                wire:key="product-card-{{ $product->id }}" 
                class="group bg-white rounded-lg overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-lg transition-all duration-300 flex flex-col h-full"
            >
                {{-- Image Section --}}
                <a href="{{ route('pages.product-detail') }}" class="block">
                    <div class="aspect-square w-full bg-gray-100 relative overflow-hidden">
                        @if($product->image_url)
                            <img 
                                src="{{ asset($product->image_url) }}" 
                                alt="{{ $product->name }}" 
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                loading="lazy"
                            >
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs p-2">
                                No Image
                            </div>
                        @endif
                    </div>
                </a>

                {{-- Content Section --}}
                <div class="p-3 flex flex-col flex-grow">
                    <h3 class="text-sm text-gray-700 truncate mb-1" title="{{ $product->name }}">
                        {{ $product->name }}
                    </h3>

                    <p class="font-bold text-base mb-1 text-gray-900">
                        IDR {{ number_format($product->base_price, 0, ',', '.') }}
                    </p>
                    
                    <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-3">
                        <span class="text-yellow-400">★</span>
                        <span>{{ $product->rating ?? '0.0' }}</span>
                        <span class="mx-1 text-gray-300">|</span>
                        <span>{{ $product->sold ?? '0' }} sold</span>
                    </div>

                    <div class="mt-auto">
                        <x-button 
                            variant="solid"
                            wire:click="addToCart({{ $product->id }})"
                            wire:loading.attr="disabled"
                            wire:target="addToCart({{ $product->id }})"
                            class="w-full py-2 rounded-lg text-[11px] font-bold transition-all flex items-center justify-center gap-2 bg-[#6B4F3B] hover:bg-[#5A4232] text-white border-none"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/>
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>
                            </svg>
                            
                            <span wire:loading.remove wire:target="addToCart({{ $product->id }})">
                                Add to Cart
                            </span>
                            <span wire:loading wire:target="addToCart({{ $product->id }})">
                                Adding...
                            </span>
                        </x-button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($showLoadMore)
        <div class="mt-12 flex justify-center">
            <button 
                wire:click="loadMore" 
                wire:loading.attr="disabled" 
                class="px-10 py-2 border border-[#6B4F3B] text-[#6B4F3B] rounded-md font-semibold hover:bg-[#6B4F3B] hover:text-white transition-all duration-300 disabled:opacity-50"
            >
                <span wire:loading.remove wire:target="loadMore">Load More</span>
                <span wire:loading wire:target="loadMore">Loading...</span>
            </button>
        </div>
    @endif
</div>