<div class="w-full flex flex-wrap items-center gap-3">
    <div class="flex flex-col flex-1 min-w[140px] max-w-[250px]">
        <div class="mb-1">
            <h3 class="font-bold text-[12px]">Category</h3>
        </div>
        <div class="relative">
            <select wire:model.live="filterCategory" class="w-full appearance-none bg-brand-100 border-none rounded-md py-2.5 pl-4 pr-10 text-[12px] font-medium text-brand-700 focus:ring-1 focus:ring-brand-500 outline-none cursor-pointer">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
    
            <span class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-brand-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7" /></svg>
            </span>
        </div>
    </div>
    
   

    <div class="flex flex-col flex-1 min-w[140px] max-w-[250px]">
        <div class="mb-1">
            <h3 class="font-bold text-[12px]">Price Range</h3>
        </div>
        <div class="relative">
            <select wire:model.live="filterPrice" class="w-full appearance-none bg-brand-100 border-none rounded-md py-2.5 pl-4 pr-10 text-[12px] font-medium text-brand-700 focus:ring-1 focus:ring-brand-500 outline-none cursor-pointer">
                <option value="">Semua Harga</option>
                <option value="under-100000">Under Rp 100.000</option>
                <option value="100000-500000">Rp 100.000 - Rp 500.000</option>
                <option value="above-500000">Above Rp 500.000</option>
            </select>
    
            <span class="absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none text-brand-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 9l-7 7-7-7" /></svg>
            </span>
        </div>
    </div>

   
</div>