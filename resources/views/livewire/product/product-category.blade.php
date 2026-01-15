<div>
    <div class="bg-brand-500 py-10 mb-6 text-white">
        <div class="max-w-[80%] mx-auto h-[150px] pt-15">
            <h1 class="text-3xl font-bold mb-4">
                {{ $search ?: ($activeCategoryName ?: 'All Products') }}
            </h1>
            
            <div class="bg-white/10 backdrop-blur-md rounded-lg px-4 py-2 inline-block border border-white/20">
                <nav class="flex items-center gap-2 text-sm">
                    <a href="/" class="hover:underline opacity-80">Home</a>
                    <span class="opacity-50">/</span>
                    <span class="{{ $search ? 'opacity-80' : 'font-bold' }}">
                        {{ $activeCategoryName ?: 'Category' }}
                    </span>
                    @if($search)
                        <span class="opacity-50">/</span>
                        <span class="font-bold">{{ $search }}</span>
                    @endif
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-[80%] mx-auto py-8 flex flex-col md:flex-row gap-8">
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="sticky top-24 bg-white border border-gray-100 rounded-xl p-5 shadow-sm">
                <h2 class="font-bold text-brand-500 mb-4 border-b pb-2 text-lg">Filter</h2>
                <h3 class="font-semibold text-sm mb-3 text-gray-700">Category</h3>
                
                <div class="space-y-2">
                    @foreach($allCategories as $cat)
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <input type="checkbox" 
                                {{ $selectedCategory == $cat->id ? 'checked' : '' }}
                                wire:click.prevent="selectCategory({{ $cat->id }})"
                                class="rounded border-gray-300 text-brand-500 focus:ring-brand-500 w-4 h-4 cursor-pointer">
                            
                            <span class="text-sm transition {{ $selectedCategory == $cat->id ? 'text-brand-500 font-bold' : 'text-gray-600 group-hover:text-brand-500' }}">
                                {{ $cat->name }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </aside>

        <div class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <p class="text-sm text-gray-600">
                    Showing <span class="font-bold text-brand-500">{{ $totalProducts }}</span> 
                    products for <span class="font-bold text-brand-500">"{{ $search ?: ($activeCategoryName ?: 'All Products') }}"</span>
                </p>

                <div x-data="{ open: false, selected: 'Most Relevant', label: { 'default': 'Most Relevant', 'ulasan': 'Ulasan', 'newest': 'Newest', 'price_high': 'Highest Price', 'price_low': 'Lowest Price' } }" 
                    class="relative inline-block w-52">
                    
                    <button @click="open = !open" @click.away="open = false" type="button"
                        class="flex items-center justify-between w-full bg-white border border-gray-200 text-gray-700 py-2 px-4 rounded-lg hover:border-brand-500 transition-all duration-200 text-sm focus:outline-none focus:ring-1 focus:ring-[#6B4F3B]">
                        <span x-text="label['{{ $sortOrder }}'] || 'Most Relevant'"></span>
                        <svg class="h-4 w-4 transition-transform duration-200 text-gray-400" :class="open ? 'rotate-180' : ''" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>

                    <div x-show="open" 
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        class="absolute z-50 mt-2 w-full bg-white border border-gray-100 rounded-xl shadow-xl overflow-hidden py-1"
                        style="display: none;">
                        
                        @foreach(['default' => 'Most Relevant', 'ulasan' => 'Ulasan', 'newest' => 'Newest', 'price_high' => 'Highest Price', 'price_low' => 'Lowest Price'] as $value => $text)
                            <button type="button"
                                wire:click="$set('sortOrder', '{{ $value }}')"
                                @click="open = false"
                                class="flex items-center w-full px-4 py-2.5 text-sm transition-colors duration-150 {{ $sortOrder === $value ? 'bg-brand-50 text-[#6B4F3B] font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-[#6B4F3B]' }}">
                                {{ $text }}
                                @if($sortOrder === $value)
                                    <svg class="ml-auto h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                @endif
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            <livewire:product.product-list 
                :key="'list-'.($selectedCategory ?? 'all').'-'.$search.'-'.$sortOrder"
                :search="$search" 
                :selectedCategories="array_filter([$selectedCategory])" 
                :sortOrder="$sortOrder"
                :columns="5"
                :limit="20"
                :showLoadMore="false" 
            />
        </div>
    </div>
</div>