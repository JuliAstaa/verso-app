<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 min-h-[500px] flex flex-col">
    {{-- HEADER & FILTERS --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-12">
        <h2 class="text-xl font-bold text-gray-800">My Wishlist</h2>
        
        <div class="flex flex-1 max-w-2xl gap-2">
            {{-- Search Bar --}}
            <div class="relative flex-1">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search your wishlist..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-1 focus:ring-[#74553d] outline-none">
            </div>

            {{-- Category Dropdown --}}
            <div x-data="{ open: false, selected: 'Category' }" class="relative">
                {{-- Menggunakan x-button untuk trigger dropdown --}}
                <x-button variant="outline" @click="open = !open" 
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium hover:bg-brand-700 hover:text-white transition justify-between text-brand-500">
                    <span x-text="selected"></span>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </x-button>
                
                <div x-show="open" 
                     @click.away="open = false" 
                     x-transition 
                     class="absolute right-0 mt-2 w-56 bg-white border border-brand-700 rounded-xl z-10 overflow-hidden py-1">
                    
                    <div @click="selected = 'All Categories'; open = false" class="px-4 py-2.5 text-sm hover:bg-gray-50 cursor-pointer border-l-4 border-transparent hover:border-[#74553d] transition-all">
                        All Categories
                    </div>

                    @isset($categories)
                        @foreach($categories as $category)
                            <div @click="selected = '{{ $category->name }}'; open = false" 
                                 class="px-4 py-2.5 text-sm hover:bg-gray-50 cursor-pointer border-l-4 border-transparent hover:border-[#74553d] transition-all">
                                {{ $category->name }}
                            </div>
                        @endforeach
                    @endisset
                </div>
            </div>

            {{-- Sort Dropdown --}}
            <div x-data="{ open: false, selected: 'Sort By' }" class="relative">
                {{-- Menggunakan x-button untuk trigger dropdown --}}
                <x-button variant="outline" @click="open = !open" 
                    class="flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-medium hover:bg-brand-700 hover:text-white transition justify-between text-brand-500">
                    <span x-text="selected"></span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path></svg>
                </x-button>

                <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white border border-brand-700 rounded-xl z-10 overflow-hidden py-1">
                    <div @click="selected = 'Latest Saved'; open = false" class="px-4 py-2 text-sm hover:bg-gray-50 cursor-pointer border-l-4 border-transparent hover:border-[#74553d]">Latest Saved</div>
                    <div @click="selected = 'Lowest Price'; open = false" class="px-4 py-2 text-sm hover:bg-gray-50 cursor-pointer border-l-4 border-transparent hover:border-[#74553d]">Lowest Price</div>
                    <div @click="selected = 'Highest Price'; open = false" class="px-4 py-2 text-sm hover:bg-gray-50 cursor-pointer border-l-4 border-transparent hover:border-[#74553d]">Highest Price</div>
                </div>
            </div>
        </div>
    </div>

    {{-- EMPTY STATE CONTENT --}}
    <div class="flex-1 flex flex-col items-center justify-center text-center pb-12">
        <div class="w-48 h-48 mb-6 bg-gray-50 rounded-2xl flex items-center justify-center border-2 border-dashed border-gray-100">
            <svg class="w-20 h-20 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
        </div>
        
        <h3 class="text-xl font-bold text-gray-800 mb-2">Your wishlist is empty</h3>
        <p class="text-sm text-gray-500 max-w-sm mb-8 leading-relaxed">
            It looks like you haven't added any items yet. <br>
            Explore our collection and save your favorite items here!
        </p>

        {{-- Button utama menggunakan x-button --}}
        <a href="/">
        <x-button variant="solid">Start Shopping</x-button>
        </a>
    </div>
</div>