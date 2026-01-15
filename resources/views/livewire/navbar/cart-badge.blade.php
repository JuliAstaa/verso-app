<div class="relative flex-shrink-0"> 
    <a href="{{ route('pages.product-cart') }}" class="text-[#6B4F3B] inline-block p-1">
        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 24 24" class="w-8 h-8 md:w-9 md:h-9">
            <path d="M10.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M17.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M8.82 15.77c.31.75 1.04 1.23 1.85 1.23h6.18c.79 0 1.51-.47 1.83-1.2l3.24-7.4c.14-.31.11-.67-.08-.95S21.34 7 21 7H7.33L5.92 3.62C5.76 3.25 5.4 3 5 3H2v2h2.33zM19.47 9l-2.62 6h-6.18l-2.5-6z"></path>
        </svg>

        @if($count > 0)
            <span class="absolute top-0 -right-1 bg-red-600 text-white text-[10px] font-bold min-w-[18px] h-[18px] flex items-center justify-center px-1 rounded-full border-2 border-white shadow-sm">
                {{ $count > 99 ? '99+' : $count }}
            </span>
        @endif
    </a>
</div>