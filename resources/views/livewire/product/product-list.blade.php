<div id="product-list-container"> 
    
    @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-64 h-64 mb-6 opacity-80">
                <img src="{{ asset('images/product/notFound.svg') }}" alt="No Products Found" class="w-full h-full object-contain">
            </div>
            
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Oops! No products found</h3>
            <p class="text-gray-500 max-w-md mx-auto mb-8">
                We couldn't find any products matching 
                <span class="font-semibold text-brand-600">"{{ $search ?: 'your selected filters' }}"</span>. 
                Please try using different keywords or clear your filters.
            </p>
        </div>
    @else
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 {{ $this->gridClass() }} gap-4 w-full" wire:loading.class="opacity-50">
            @foreach($products as $product)
                <div 
                    wire:key="product-card-{{ $product->id }}" 
                    class="group bg-white rounded-lg overflow-hidden border border-gray-100 hover:border-gray-200 hover:shadow-lg transition-all duration-300 flex flex-col h-full"
                >
                    <a href="{{ route('product.detail', $product->slug) }}" class="block">
                        <div class="aspect-square w-full bg-gray-100 relative overflow-hidden">
                            @php
                                $primaryImage = $product->images->first();
                            @endphp
                            @if($primaryImage)
                                {{-- 2. Tampilkan kalau ada (Pake Storage::url ya, jangan asset) --}}
                                <img 
                                    src="{{ Storage::url($primaryImage->image_path) }}" 
                                    alt="{{ $product->name }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                >
                            @else
                                {{-- 3. Placeholder kalau gak ada gambar --}}
                                <div class="w-full h-full flex items-center justify-center text-gray-400 bg-gray-50">
                                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif
                        </div>
                    </a>

                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="text-sm text-gray-700 truncate mb-1" title="{{ $product->name }}">
                            {{ $product->name }}
                        </h3>

                        <p class="font-bold text-base mb-1 text-gray-900">
                            IDR {{ number_format($product->base_price, 0, ',', '.') }}
                        </p>
                        
                        <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-3">
                            <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-3">
                                <span class="text-yellow-400">★</span>
                                
                                <span>{{ $product->rating_value }}</span> 

                                <span class="mx-1 text-gray-300">|</span>
                                <span>{{ $this->formatCompactNumber($product->sold_count) }} Sold</span>
                            </div>
                        </div>  

                        <div class="mt-auto">
                            <x-btn-loading 
                                action="addToCart({{ $product->id }})" 
                                loadingText="Adding..." 
                                class="w-full py-2 bg-[#6B4F3B] text-white rounded-lg hover:bg-[#5A4232]"
                            >
                                {{-- Masukin Icon Keranjang di sini --}}
                                
                                                    Add to Cart
                            </x-btn-loading>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($showPagination)
            <div class="mt-4">
                {{ $products->links('vendor.pagination.custome-verso') }}
            </div>
        @endif

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
    @endif
</div>