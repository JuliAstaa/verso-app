<div class="border border-gray-200 rounded-xl p-4 space-y-5 bg-white shadow-sm ring-1 ring-gray-50">
    <h3 class="font-bold text-md text-gray-800">Set quantity and notes</h3>
    
    <div class="flex items-center gap-3 bg-gray-50 p-2 rounded-lg">
        <div class="w-12 h-12 bg-gray-200 rounded flex-shrink-0 overflow-hidden">
            <img src="https://placehold.co/125x125" class="w-full h-full object-cover opacity-80">
        </div>
        <p class="text-sm font-medium text-gray-600 line-clamp-2">Green, L (T3)</p>
    </div>

    <div class="space-y-3">
        <div class="flex items-center gap-4">
            <div class="flex items-center border border-gray-300 rounded-sm px-1 py-0.5 focus-within:ring-1 focus-within:ring-[#6B4F3B]">
                <button class="px-2 py-1 text-[#6B4F3B] font-bold hover:bg-gray-100 rounded text-sm">-</button>
                <input type="text" value="1" class="w-10 text-center border-none focus:ring-0 text-xs font-bold bg-transparent text-gray-800">
                <button class="px-2 py-1 text-[#6B4F3B] font-bold hover:bg-gray-100 rounded text-sm">+</button>
            </div>
            <p class="text-[11px] text-gray-500">
                Stock: <span class="text-orange-500 font-bold italic">Remaining 1</span>
            </p>
        </div>
        
    </div>

    <div class="flex justify-between items-center pt-2">
        <span class="text-brand-500 text-sm italic">Subtotal</span>
        <span class="text-lg font-black text-gray-900 tracking-tight">IDR448.106</span>
    </div>

    <div class="flex gap-2 pt-2">
        <x-button variant="outline" class="flex-1 text-sm">Buy Now</x-button>
        <x-button variant="solid" class="flex-1 text-sm">Add to Cart</x-button>
    </div>

    <div class="flex justify-between items-center text-sm font-bold text-black px-1 pt-2">
        <button class="hover:text-brand-500 flex items-center gap-1.5 transition-colors">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-message-circle-more-icon lucide-message-circle-more"><path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719"/><path d="M8 12h.01"/><path d="M12 12h.01"/><path d="M16 12h.01"/></svg>
            </span> Chat
        </button>
        <div class="w-[1px] h-5 bg-gray-200"></div>
        <button class="hover:text-brand-500 flex items-center gap-1.5 transition-colors">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-heart-icon lucide-heart"><path d="M2 9.5a5.5 5.5 0 0 1 9.591-3.676.56.56 0 0 0 .818 0A5.49 5.49 0 0 1 22 9.5c0 2.29-1.5 4-3 5.5l-5.492 5.313a2 2 0 0 1-3 .019L5 15c-1.5-1.5-3-3.2-3-5.5"/></svg>
            </span> Wishlist
        </button>
        <div class="w-[1px] h-5 bg-gray-200"></div>
        <button class="hover:text-brand-500 flex items-center gap-1.5 transition-colors">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
                </svg>
            </span> Share
        </button>
    </div>
</div>