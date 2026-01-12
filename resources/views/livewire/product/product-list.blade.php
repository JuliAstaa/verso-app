<div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($products as $product)
            <a href="{{ route('pages.product-detail') }}" class="group bg-white rounded-lg overflow-hidden border border-transparent hover:border-gray-200 hover:shadow-lg transition-all duration-300 cursor-pointer">
                <div class="aspect-square w-full bg-[#D9D9D9] relative overflow-hidden">
                    @if($product['image'])
                        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No Image</div>
                    @endif
                </div>

                <div class="p-3">
                    <h3 class="text-sm text-gray-700 line-clamp-2 mb-1">{{ $product['name'] }}</h3>
                    <p class="font-bold text-base mb-1">IDR{{ number_format($product['price'], 0, ',', '.') }}</p>
                    
                    <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-2">
                        <span class="text-yellow-400">★</span>
                        <span>{{ $product['rating'] }}</span>
                        <span class="mx-1">|</span>
                        <span>{{ $product['sold'] }} sold</span>
                    </div>

                    <p class="text-[11px] text-gray-500">{{ $product['location'] }}</p>
                </div>
            </a>
        @endforeach
    </div>

    <div class="mt-12 flex justify-center">
        @if($showLoadMore)
            <button 
                wire:click="loadMore" 
                wire:loading.attr="disabled"
                class="px-10 py-2 border border-[#6B4F3B] text-[#6B4F3B] rounded-md font-semibold hover:bg-[#6B4F3B] hover:text-white transition-colors disabled:opacity-50"
            >
                <span wire:loading.remove>Load More</span>
                <span wire:loading>Loading...</span>
            </button>
        @endif
    </div>
</div>