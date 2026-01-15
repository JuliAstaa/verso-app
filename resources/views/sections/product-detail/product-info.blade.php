<div class="space-y-6">
    <section>
        <h1 class="text-xl font-bold text-gray-900 leading-tight">SISTER'S BLOUSE - Kemeja Atasan Wanita Katun Bordir Y9462 (ZE) - Hijau, L (T3)</h1>
        <h2 class="text-3xl font-extrabold text-gray-900 mt-4">IDR448.106</h2>
        <div class="flex items-center gap-2 mt-2">
            <span class="text-sm text-gray-500">Sold <span class="text-gray-900 font-medium">10 rb+</span></span>
            <span class="text-gray-300">•</span>
            <span class="flex gap-2 items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-4 text-yellow-500" fill="currentColor"><path d="M309.5-18.9c-4.1-8-12.4-13.1-21.4-13.1s-17.3 5.1-21.4 13.1L193.1 125.3 33.2 150.7c-8.9 1.4-16.3 7.7-19.1 16.3s-.5 18 5.8 24.4l114.4 114.5-25.2 159.9c-1.4 8.9 2.3 17.9 9.6 23.2s16.9 6.1 25 2L288.1 417.6 432.4 491c8 4.1 17.7 3.3 25-2s11-14.2 9.6-23.2L441.7 305.9 556.1 191.4c6.4-6.4 8.6-15.8 5.8-24.4s-10.1-14.9-19.1-16.3L383 125.3 309.5-18.9z"/></svg>
                <span class="text-xs text-gray-400">
                     4.9 (1.2rb review)
                </span>
            </span>
        </div>
        <div id="detail-section"></div>
    </section>

    <hr class="border-gray-200">

    <section>
        <p class="text-sm font-bold">Choose Color: <span class="text-gray-400 font-normal">Green</span></p>
        <div class="flex flex-wrap gap-2 mt-3">
            @foreach (['Yellow', 'Green', 'Red', 'Black', 'Blue'] as $color)
                <button class="px-4 py-2 border {{ $loop->index == 1 ? 'border-brand-500 text-brand-500 bg-brand-100' : 'border-gray-200 text-gray-500'}} rounded-sm text-xs font-bold ">
                    {{ $color }}
                </button>
            @endforeach
        </div>
    </section>

    <section>
        <p class="text-sm font-bold">Select Size: <span class="text-gray-400 font-normal">L (T3)</span></p>
        <div class="flex flex-wrap gap-2 mt-3">
            @foreach(['M (T2)', 'L (T3)', 'XL (T4)', '2L (T5)', '3L (T6)', '4L (T7)', '5L (T8)'] as $size)
                <button class="px-3 py-2 border {{ $loop->index == 1 ? 'border-brand-500 text-brand-500 bg-brand-100' : 'border-gray-200 text-gray-500' }} rounded-sm text-[11px] font-bold">
                    {{ $size }}
                </button>
            @endforeach
        </div>
    </section>

    <section class="pt-4 border-t border-gray-200">
        <div class="flex gap-8 mb-4">
            <button class="pb-2 border-b-2 border-brand-500 cursor-pointer text-sm font-bold">Product Details</button>
        </div>
        
        <div class="text-sm space-y-1 text-gray-600">
            <p>Condition: <span class="text-gray-900 font-medium italic">New</span></p>
            <p>Min. Order: <span class="text-gray-900 font-medium italic">1 Piece</span></p>
            <p>Display Case: <span class="text-brand font-bold italic">NEW Arrivals</span></p>
        </div>
        
        <div id="reviews-section"></div>
    </section>

    <section class="pt-6 border-t border-gray-200">
        <h3 class="font-bold text-sm mb-4">Delivery</h3>
        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <span class="text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-map-pin-icon lucide-map-pin"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/></svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Send from <span class="font-bold text-gray-900 italic">Denpasar City</span></p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <span class="text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-truck-icon lucide-truck"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14"/><circle cx="17" cy="18" r="2"/><circle cx="7" cy="18" r="2"/></svg>
                </span>
                <div>
                    <p class="text-xs text-gray-500">Shipping Start <span class="font-bold text-gray-900 italic">IDR 8.000</span></p>
                    <p class="text-[10px] text-gray-400">Estimated arrival tommorow - 23 Jan</p>
                </div>
            </div>
        </div>
    </section>
</div>