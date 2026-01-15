<div class="relative w-full" x-data="{ open: false }" @click.away="open = false">
    <form class="flex items-center" wire:submit.prevent="handleSearch">
        <div class="relative w-full">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 md:w-6 md:h-6 text-brand-500" fill="currentColor" viewbox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </div>
            
            <input 
                type="text" 
                wire:model.live="searchQuery"
                @focus="open = true"
                @input="open = true"
                class="block w-full p-2 pl-10 text-sm text-[#6B4F3B] border border-brand-500 rounded-xl bg-white focus:ring-1 focus:ring-brand-700 outline-none" 
                placeholder="Search in Verso" 
                autocomplete="off"
            >
        </div>
    </form>

    <div 
        x-show="open && $wire.searchQuery.length > 0" 
        x-cloak
        class="absolute z-[100] w-full mt-1 bg-white border border-gray-200 rounded-md shadow-xl overflow-hidden"
    >
        <div class="max-h-72 overflow-y-auto custom-scrollbar">
            @if(count($suggestions) > 0)
                @foreach($suggestions as $product)
                    <a href="{{ route('product.category', ['search' => $product['name']]) }}" 
                       class="flex items-center gap-3 px-4 py-3 hover:bg-gray-50 transition border-b border-gray-50 last:border-none group">
                        <svg class="w-4 h-4 text-gray-400 group-hover:text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="text-sm text-gray-700 font-medium">{{ $product['name'] }}</span>
                    </a>
                @endforeach
            @else
                <div class="px-4 py-8 text-center bg-gray-50/50">
                    <p class="text-sm text-gray-500">
                        Product <span class="font-bold text-brand-500">"{{ $searchQuery }}"</span> not found!.
                    </p>
                </div>
            @endif
        </div>
    </div>

    <style>
        [x-cloak] { display: none !important; }
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #6B4F3B; border-radius: 10px; }
    </style>
</div>