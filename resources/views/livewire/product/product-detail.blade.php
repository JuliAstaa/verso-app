<div> 
    <div 
        x-data="{ 
            showSubNav: false,
            activeTab: 'detail',
            handleScroll() {
                this.showSubNav = window.scrollY > 10;
            }
        }" 
        x-init="window.addEventListener('scroll', () => handleScroll())"
        x-show="showSubNav"
        x-cloak
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        class="fixed top-[165px] left-0 w-full z-[90] bg-white border-b border-gray-100 shadow-sm lg:block"
        >
        <div class="w-[80%] mx-auto h-16 grid grid-cols-12 items-center">
            <div class="col-span-3">
                <p class="text-[16px] font-bold text-gray-800 truncate pr-10 italic">
                    {{ $product->name }}
                </p>
            </div>
            
            <div class="col-span-6 flex justify-center gap-12 h-full">
                <a href="#detail-section" 
                   @click="activeTab = 'detail'"
                   :class="activeTab === 'detail' ? 'text-[#6B4F3B] border-[#6B4F3B] font-bold' : 'text-gray-500 border-transparent font-medium'"
                   class="h-full flex items-center text-sm border-b-2 transition-colors duration-200">
                   Product Detail
                </a>

                <a href="#reviews-section" 
                   @click="activeTab = 'review'"
                   :class="activeTab === 'review' ? 'text-[#6B4F3B] border-[#6B4F3B] font-bold' : 'text-gray-500 border-transparent font-medium'"
                   class="h-full flex items-center text-sm border-b-2 transition-colors duration-200 hover:text-[#6B4F3B]">
                   Reviews
                </a>

                <a href="#recommendation-section" 
                   @click="activeTab = 'recommend'"
                   :class="activeTab === 'recommend' ? 'text-[#6B4F3B] border-[#6B4F3B] font-bold' : 'text-gray-500 border-transparent font-medium'"
                   class="h-full flex items-center text-sm border-b-2 transition-colors duration-200 hover:text-[#6B4F3B]">
                   Recommendation
                </a>
            </div>

            <div class="col-span-3"></div>
        </div>
    </div>

    <main class="w-[80%] mx-auto py-8">
        <nav class="text-sm text-brand-500 mb-4 flex gap-2 italic">
            <a href="{{ route('pages.home') }}" class="text-brand-500">Home</a>
            <span>&rsaquo;</span>
            <a href="#" class="font-medium italic">{{ $product->category->name ?? 'Category' }}</a>
            <span>&rsaquo;</span>
            <a href="#" class="font-medium italic">{{ $product->name }}</a>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start relative">
            
            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-[40%_60%] gap-4 items-start border-b border-gray-200 pb-10">
                    
                    <div class="lg:sticky lg:top-[245px] w-[95%]"> 
                        @include('sections.product-detail.product-img')
                    </div>

                    <div class="mb-6"> 
                        @include('sections.product-detail.product-info')
                        <div id="reviews-section"></div>
                    </div>
                </div>
                
                <div class="pt-10">
                    <h2 class="text-xl font-medium mb-4">Buyer Reviews</h2>
                    <livewire:product.product-reviews :productId="$product->id" />
                </div>
            </div>

            <aside class="lg:col-span-4 lg:sticky lg:top-[245px] w-[95%] justify-self-end">
                <div class="border border-gray-200 rounded-xl p-4 space-y-5 bg-white shadow-sm ring-1 ring-gray-50">
                    <h3 class="font-bold text-md text-gray-800">Set quantity and notes</h3>
                    
                    <div class="flex items-center gap-3 bg-gray-50 p-2 rounded-lg">
                        <div class="w-12 h-12 bg-gray-200 rounded flex-shrink-0 overflow-hidden">
                            @if($product->image_url)
                                <img src="{{ $currentVariant->image_url ?? $product->image_url ?? 'https://placehold.co/125x125' }}" 
                                    class="w-full h-full object-cover opacity-80"
                                    alt="Selected Variant">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-[5px] p-2">
                                    No Image
                                </div>
                            @endif
                        </div>
                        <p class="text-sm font-medium text-gray-600 line-clamp-2">
                            {{ $selectedColor ?? '-' }}, {{ $selectedSize ?? '-' }}
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center border border-gray-300 rounded-sm px-1 py-0.5 focus-within:ring-1 focus-within:ring-[#6B4F3B]">
                                <button wire:click="decrement" 
                                        class="px-2 py-1 text-[#6B4F3B] font-bold hover:bg-gray-100 rounded text-sm transition-colors cursor-pointer">
                                    -
                                </button>
                                
                                <input wire:model.live="quantity" 
                                    type="text" 
                                    class="w-10 text-center border-none focus:ring-0 text-xs font-bold bg-transparent text-gray-800"
                                    readonly>

                                <button wire:click="increment" 
                                        class="px-2 py-1 text-[#6B4F3B] font-bold hover:bg-gray-100 rounded text-sm transition-colors cursor-pointer">
                                    +
                                </button>
                            </div>
                            
                            <p class="text-[11px] text-gray-500">
                                Stock: 
                                @if(($currentVariant->stock ?? 0) > 0)
                                    <span class="text-orange-500 font-bold italic">Remaining {{ $currentVariant->stock }}</span>
                                @else
                                    <span class="text-red-500 font-bold italic">Out of Stock</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-2">
                        <span class="text-brand-500 text-sm italic">Subtotal</span>
                        <span class="text-lg font-black text-gray-900 tracking-tight">
                            IDR {{ number_format(($currentVariant->price ?? $product->price) * $quantity, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex gap-2 pt-2">
                        <x-button variant="outline" class="flex-1 text-sm">Buy Now</x-button>
                        <x-button wire:click="addToCart" 
                                wire:loading.attr="disabled"
                                variant="solid" 
                                class="flex-1 text-sm bg-[#6B4F3B] hover:bg-[#5a4232] text-white"
                                :disabled="($currentVariant->stock ?? 0) <= 0">
                            <span wire:loading.remove wire:target="addToCart">Add to Cart</span>
                            <span wire:loading wire:target="addToCart">Processing...</span>
                        </x-button>
                    </div>

                    <div class="flex justify-between items-center text-sm font-bold text-black px-1 pt-2">
                        <button class="hover:text-brand-500 flex items-center gap-1.5 transition-colors cursor-pointer">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-more"><path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
                            </span> Chat
                        </button>
                        <div class="w-[1px] h-5 bg-gray-200"></div>
                        <button class="hover:text-brand-500 flex items-center gap-1.5 transition-colors cursor-pointer">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
                            </span> Wishlist
                        </button>
                        <div class="w-[1px] h-5 bg-gray-200"></div>
                        <button class="hover:text-brand-500 flex items-center gap-1.5 transition-colors cursor-pointer">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                                </svg>
                            </span> Share
                        </button>
                    </div>
                </div>
            </aside>

        </div>

        <div id="recommendation-section"></div>

        <div class="mt-25">
            <h1 class="w-fit text-xl border-b-2 border-brand-500 font-bold mb-6">Product Recommendations</h1>
            <livewire:product.product-list 
                :showLoadMore="false" 
                :showPagination="false" 
                :limit="14" 
                :columns="6" 
            />
        </div>
    </main>

    <style>
        html {
            scroll-behavior: smooth;
        }
        #detail-section, #reviews-section, #recommendation-section {
            scroll-margin-top: 150px; 
        }
    </style>

</div>