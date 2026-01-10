<div class="group relative flex flex-col bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden" 
     wire:key="size-item-{{ $size->id }}">
    
    <div class="h-24 bg-gray-50 flex flex-col items-center justify-center border-b border-gray-100 group-hover:bg-[#FDFCFB] transition-colors">
        
        <span class="text-3xl font-black text-gray-700 tracking-tighter">
            {{ $size->code }}
        </span>
        
        @if($size->name)
            <span class="text-[10px] text-3xl  uppercase tracking-widest text-gray-400 mt-1 font-medium">
                {{ $size->name }}
            </span>
        @endif
    </div>

    <div class="flex items-center justify-between p-3 bg-white">
        
        <span class="text-[10px] text-gray-300 font-mono">
            #{{ $size->id }}
        </span>

        <div class="flex items-center gap-1">
            {{-- Edit --}}
            <button wire:click="edit({{ $size->id }})" title="Edit Size" class="p-2 text-brand-500 hover:bg-brand-500 hover:text-white rounded-lg transition-all border border-transparent hover:border-brand-600 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
            </button>
            <button 
                type="button"
                wire:click="confirmDelete({{ $size->id }})"
                title="Delete Size " 
                class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all border border-transparent hover:border-red-600 cursor-pointer"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            </button>
        </div>
    </div>
</div>