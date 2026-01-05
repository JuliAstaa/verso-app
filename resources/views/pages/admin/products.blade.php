<x-layouts.admin title="Admin Products - Verso">
    <div class="flex flex-col h-full gap-3">
        <!-- Sections Product-Controls) -->
        <div class="bg-white w-full py-3 px-5 rounded-sm shadow-sm shrink-0">
            @include('sections.admin.products.product-controls')
        </div>
    
        <!-- Sections Product-Filters -->
        <div class="mt-2.5 bg-white w-full py-3 px-5 rounded-sm shadow-sm shrink-0">
            @include('sections.admin.products.product-filters')
        </div>
    
        <!-- Sections Product-Table -->
        <div class="flex flex-col flex-1 mt-1 bg-white w-full py-3 px-5 rounded-sm shadow-sm overflow-hidden">
            <div class="flex-1 overflow-y-auto px-5 pt-3">
                @include('sections.admin.products.product-table')
            </div>
    
            <!-- Pagination Sementara -->
            <div class="shrink-0 flex items-center justify-center gap-2 pt-7 pb-2">
                <button class="p-2 text-gray-400 hover:text-brand-500 hover:bg-brand-50 rounded-lg transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
    
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">1</button>
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">2</button>
                
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-bold bg-brand-100 text-brand-600 border border-brand-200">3</button>
                
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">4</button>
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">5</button>
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">6</button>
                
                <span class="text-gray-400 px-1">...</span>
                
                <button class="w-9 h-9 flex items-center justify-center rounded-lg text-[13px] font-medium text-gray-500 hover:bg-gray-100 transition-all cursor-pointer">24</button>
    
                <button class="p-2 text-gray-400 hover:text-brand-500 hover:bg-brand-50 rounded-lg transition-all cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</x-layouts.admin>