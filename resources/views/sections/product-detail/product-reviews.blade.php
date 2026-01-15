<div class="flex flex-col lg:flex-row gap-10 items-start">
    <div class="w-full lg:w-56 sticky top-24 space-y-4 p-3 border border-brand-200 rounded-md">
        <p class="text-sm font-bold text-gray-900 border-b border-gray-200 pb-3">REVIEW FILTER</p>
        <div class="space-y-3">
            @foreach([5,4,3,2,1] as $star)
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand focus:ring-brand">
                <div class="flex items-center gap-1">
                    <span class="text-yellow-400 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-4 text-yellow-500" fill="currentColor"><path d="M309.5-18.9c-4.1-8-12.4-13.1-21.4-13.1s-17.3 5.1-21.4 13.1L193.1 125.3 33.2 150.7c-8.9 1.4-16.3 7.7-19.1 16.3s-.5 18 5.8 24.4l114.4 114.5-25.2 159.9c-1.4 8.9 2.3 17.9 9.6 23.2s16.9 6.1 25 2L288.1 417.6 432.4 491c8 4.1 17.7 3.3 25-2s11-14.2 9.6-23.2L441.7 305.9 556.1 191.4c6.4-6.4 8.6-15.8 5.8-24.4s-10.1-14.9-19.1-16.3L383 125.3 309.5-18.9z"/></svg>
                    </span>
                    <span class="text-xs font-medium text-gray-600 group-hover:text-brand">{{ $star }}</span>
                </div>
            </label>
            @endforeach
        </div>
    </div>

    <div class="flex-1">
        <div class="flex flex-col mb-10 p-6 bg-gray-50 rounded-xl border border-brand-100">
            <p class="text-sm font-bold mb-3 italic text-brand-500 text-center">How is the quality of this product?</p>
            <div x-data="{ rating: 0, hoverRating: 0 }" class="flex justify-center gap-3 mb-4">
                @for($i = 1; $i <= 5; $i++) 
                    <span 
                        class="cursor-pointer transition-colors duration-200"
                        @click="rating = {{ $i }}"
                        @mouseenter="hoverRating = {{ $i }}"
                        @mouseleave="hoverRating = 0"
                        :class="(hoverRating >= {{ $i }} || rating >= {{ $i }}) ? 'text-yellow-400' : 'text-gray-300'"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-6" fill="currentColor">
                            <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.8 33.8-2.3s14.8-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                    </span> 
                @endfor

                {{-- Input hidden untuk mengirim data ke backend nanti (jika perlu) --}}
                <input type="hidden" name="rating" :value="rating">
            </div>
            <textarea placeholder="Write your review here..." class="w-full p-4 bg-white border border-gray-100 rounded-md text-sm focus:ring-1 focus:ring-brand-300 outline-none h-28 mb-4"></textarea>
            <x-button variant="solid" class="flex-1 text-sm">Send Reviews</x-button>
        </div>

        <div class="space-y-8">
            @for($i=0; $i<5; $i++)
            <div class="p-4 border border-gray-200 rounded-md">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name=User" alt="User">
                    </div>
                    <div>
                        <p class="text-sm font-bold text-gray-900">Arya Chindo</p>
                        <p class="text-[10px] text-gray-400">11 months ago</p>
                    </div>
                </div>
                <div class="text-yellow-400 text-md mb-2">★★★★★</div>
                <p class="text-sm text-gray-700 leading-relaxed mb-4">
                    Alhamdulillah paketnya sudah sampai, bahannya adem banget! Sesuai ekspektasi dan pengiriman cepat.
                </p>
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <button class="flex items-center gap-2 text-[12px] text-black hover:text-brand-500 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up-icon lucide-thumbs-up"><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/><path d="M7 10v12"/></svg>     
                            <span class="mt-1">2</span>
                        </button>

                        <button class="flex items-center text-[12px] text-black hover:text-brand-500 mt-1 cursor-pointer">
                            <span>Show Reply</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 transform transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </div>
                    <button class="flex items-center gap-2 text-[12px] text-black hover:text-brand-500">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-reply-icon lucide-reply"><path d="M20 18v-2a4 4 0 0 0-4-4H4"/><path d="m9 17-5-5 5-5"/></svg>
                        <span>Reply</span>
                    </button>
                </div>

                <!-- Balas Komentar -->
                <div class="flex justify-end mt-5">
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name=User" alt="User">
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Arya Chindo</p>
                                <p class="text-[9px] text-gray-400">11 months ago</p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-700 leading-relaxed mb-4">
                            Alhamdulillah paketnya sudah sampai, bahannya adem banget! Sesuai ekspektasi dan pengiriman cepat.
                        </p>
                        <div class="flex items-center justify-between gap-4">
                            <button class="flex items-center gap-2 text-[11px] text-black hover:text-brand-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-thumbs-up-icon lucide-thumbs-up"><path d="M15 5.88 14 10h5.83a2 2 0 0 1 1.92 2.56l-2.33 8A2 2 0 0 1 17.5 22H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h2.76a2 2 0 0 0 1.79-1.11L12 2a3.13 3.13 0 0 1 3 3.88Z"/><path d="M7 10v12"/></svg>     
                                <span class="mt-1">2</span>
                            </button>
                            <button class="flex items-center gap-2 text-[11px] text-black hover:text-brand-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-reply-icon lucide-reply"><path d="M20 18v-2a4 4 0 0 0-4-4H4"/><path d="m9 17-5-5 5-5"/></svg>
                                <span>Reply</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endfor

            <!-- Pagination -->
             <div class="flex justify-center">1 2 3 4 5</div>
        </div>
    </div>
</div>
<div id="recommendation-section"></div>