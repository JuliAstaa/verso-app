
<div title="{{ $color->name }}" class="flex gap-5 justify-between" wire:key="color-item-{{ $color->id }}">
    <div class="flex items-center gap-3">
            <div class="w-30 h-11 rounded-sm ] overflow-hidden flex-shrink-0 border shadow-sm"
            style="background-color: {{ $color->hex_code }}">
            </div>
            <div class="flex flex-col">
                <span  class="text-[13px] font-bold text-gray-800 leading-tight max-w-[130px] truncate">{{ $color->name }}
                </span>
                <span class="text-[11px] text-gray-400 mt-0.5 font-medium italic">{{ $color->hex_code }}</span>
            </div>
        </div>
        <div class="flex items-center justify-center gap-2">
            <button wire:click="edit({{ $color->id }})" title="Edit Color" class="p-2 text-brand-500 hover:bg-brand-500 hover:text-white rounded-lg transition-all border border-transparent hover:border-brand-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
            </button>
            <button 
                type="button"
                wire:click="confirmDelete({{ $color->id }})"
                title="Delete Color" 
                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all border border-transparent hover:border-red-600 cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            </button>
        </div>
    </div>
