<div class="w-full flex flex-wrap items-center justify-between gap-2">
    
    <div class="flex items-center gap-2 flex-1 min-w-[200px]">
        <div class="flex items-center gap-1 bg-brand-100 p-1 rounded-md">
            <button class="p-1 rounded-sm bg-white text-brand-500 border cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>

            </button>
            <button class="p-1 rounded-sm text-brand-300 hover:text-brand-500 cursor-pointer transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/></svg>
            </button>
        </div>

        <div class="relative flex-1 max-w-md">
            <span class="absolute inset-y-0 left-3 flex items-center text-brand-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" 
                    placeholder="Search Category"
                    wire:model.live="search" 
                    class="w-full bg-brand-100 rounded-md py-2.5 ps-9 pe-4 text-[12px] focus:ring-1 focus:ring-brand-500 focus:bg-white transition-all outline-none"
            >
        </div>
    </div>

    <div class="flex flex-wrap items-center gap-2 shrink-0">
        
        <div class="relative hidden lg:block">
            <div class="absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none text-[12px] font-medium">
                <span class="text-brand-500">Sort By: </span>
            </div>

            <select wire:model.live="orderBy" class="appearance-none bg-brand-100 border-none rounded-md py-2.5 pl-16 pr-8 text-[12px] font-medium text-brand-700 focus:ring-1 focus:ring-brand-500 outline-none cursor-pointer">
                <option value="desc">Newest First</option>
                <option value="asc">Latest</option>
            </select>

            <span class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-brand-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7" /></svg>
            </span>
        </div>

        <button wire:click="create" class="flex items-center gap-2 bg-brand text-white bg-brand-500 px-3 py-2 rounded-md text-sm font-medium  hover:brightness-110 active:scale-95 transition-all cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            <span class="whitespace-nowrap">Add Category</span>
        </button>
    </div>

</div>