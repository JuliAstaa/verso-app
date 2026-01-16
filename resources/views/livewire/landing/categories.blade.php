<section class="w-full bg-white py-12">
    <div class="mx-auto max-w-[95%] lg:max-w-[80%] bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
        
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Explore Categories</h2>
                <p class="text-sm text-gray-500">Find what you need in our curated collections</p>
            </div>
            
            <div class="flex gap-2">
                <button @click="$refs.slider.scrollBy({left: -$refs.slider.offsetWidth, behavior: 'smooth'})"
                    class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition shadow-sm active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6B4F3B]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                </button>
                <button @click="$refs.slider.scrollBy({left: $refs.slider.offsetWidth, behavior: 'smooth'})"
                    class="p-2 rounded-full border border-gray-200 hover:bg-gray-50 transition shadow-sm active:scale-90">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#6B4F3B]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                </button>
            </div>
        </div>

        <div x-ref="slider"
            class="flex overflow-x-auto snap-x snap-mandatory scrollbar-hide gap-0 items-start"
            style="scrollbar-width: none; -ms-overflow-style: none;">
            
            @forelse($categoryChunks as $chunk)
                <div class="min-w-full snap-start grid grid-cols-4 md:grid-cols-7 grid-rows-2 gap-4 px-1 content-start">
                    @foreach($chunk as $cat)
                        <a href="{{ route('product.category', ['c' => $cat->id]) }}" class="group flex flex-col items-center p-3 border border-gray-100 rounded-xl hover:border-brand-500 hover:shadow-sm transition-all duration-300 h-fit bg-white">
                            <div class="w-full aspect-square mb-2 overflow-hidden rounded-lg bg-gray-50 flex items-center justify-center">
                                @if($cat->images)
                                    <img 
                                        src="{{ asset('storage/' . $cat->images) }}" 
                                        alt="{{ $cat->name }}" 
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                        loading="lazy">
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs p-2">
                                        No Image
                                    </div>
                                @endif
                            </div>
                            <h3 class="text-center text-[10px] md:text-[11px] font-bold text-gray-700 group-hover:text-brand-500 truncate w-full uppercase tracking-tighter">
                                {{ $cat->name }}
                            </h3>
                        </a>
                    @endforeach
                </div>
            @empty
                <div class="w-full text-center py-10 text-gray-400 italic">No Categories.</div>
            @endforelse
        </div>
    </div>
</section>