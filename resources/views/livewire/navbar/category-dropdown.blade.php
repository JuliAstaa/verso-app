<div class="relative" x-data="{ open: false }">
    <button 
        @click="open = !open" 
        class="text-xl text-brand-500 cursor-pointer font-bold hover:text-opacity-80 transition py-2"
    >
        <span>Category</span>
    </button>

    <div 
        x-show="open" 
        x-cloak
        @click.away="open = false"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="absolute left-0 mt-2 w-[1200px] bg-white border border-gray-100 rounded-xl shadow-2xl z-[110] overflow-hidden"
    >
        <div class="p-8">
            <h3 class="text-brand-500 font-bold text-lg mb-6 border-b border-gray-100 pb-2">All Categories</h3>
            
            <div class="grid grid-flow-col grid-rows-[repeat(15,minmax(0,1fr))] gap-x-10 gap-y-2 h-[400px] overflow-x-auto">
                @forelse($categories as $category)
                    <a 
                        href="{{ route('product.category', ['c' => $category->id]) }}" 
                        class="text-sm text-gray-600 hover:text-brand-700 hover:font-semibold transition flex items-center gap-2 group min-w-[180px]"
                    >
                        <span class="w-1 h-1 bg-gray-300 rounded-full group-hover:bg-brand-500 flex-shrink-0"></span>
                        
                        <span class="truncate" title="{{ $category->name }}">
                            {{ $category->name }}
                        </span>
                    </a>
                @empty
                    <p class="text-sm text-gray-400 italic">No categories available.</p>
                @endforelse
            </div>
        </div>
        
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-100 flex justify-between items-center">
            <a href="{{ route('product.category') }}" class="text-xs text-brand-700 font-bold hover:underline uppercase tracking-wider">
                View All Products
            </a>
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</div>