@if ($paginator->hasPages())
    <div class="shrink-0 flex items-center justify-center gap-2 pt-7 pb-2">
        
        {{-- Tombol Previous --}}
        @if ($paginator->onFirstPage())
            <button disabled class="p-2 text-gray-300 rounded-lg cursor-not-allowed opacity-50">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
        @else
            <button wire:click="previousPage" wire:loading.attr="disabled" class="p-2 text-gray-400 hover:text-[#5B4636] hover:bg-[#5B4636]/10 rounded-lg transition-all cursor-pointer">
                 <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>
        @endif

        {{-- Loop Nomor Halaman --}}
        @foreach ($elements as $element)
            
            {{-- Kalau separator "..." --}}
            @if (is_string($element))
                <span class="text-gray-400 px-1">{{ $element }}</span>
            @endif

            {{-- Kalau Array Halaman --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        {{-- STYLE AKTIF (Nomor 3 di contohmu) --}}
                        {{-- Aku ganti warna brand jadi Coklat (#5B4636) biar matching sama tombolmu yang lain --}}
                        <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-bold bg-[#5B4636] text-white border border-[#5B4636] shadow-sm cursor-default">
                            {{ $page }}
                        </button>
                    @else
                        {{-- STYLE NON-AKTIF --}}
                        <button wire:click="gotoPage({{ $page }})" class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">
                            {{ $page }}
                        </button>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($paginator->hasMorePages())
            <button wire:click="nextPage" wire:loading.attr="disabled" class="p-2 text-gray-400 hover:text-[#5B4636] hover:bg-[#5B4636]/10 rounded-lg transition-all cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        @else
            <button disabled class="p-2 text-gray-300 rounded-lg cursor-not-allowed opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        @endif

    </div>
@endif