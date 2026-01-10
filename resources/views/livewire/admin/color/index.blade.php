
    <div class="flex flex-col h-full gap-3">

        <!-- section create color -->

        @if($isModalOpen)
            @include('sections.admin.colors.modal-form-color')
        @endif

        <!-- Sections Color-Controls) -->
        <div class="bg-white w-full py-3 px-5 rounded-sm shadow-sm shrink-0">
            @include('sections.admin.colors.color-control')
        </div>
        <!-- Sections Color-Table -->
        <div class="flex flex-col flex-1 mt-1 bg-white w-full py-3 px-5 rounded-sm shadow-sm overflow-hidden">
            <div class="flex-1 overflow-y-auto px-5 pt-3">
                <div class="w-full overflow-x-auto">
                    <div class="grid grid-cols-4 gap-5 gap-y-10">
                        @forelse($colors as $color)
                            @include('sections.admin.colors.color-card', ['color' => $color])
                        @empty
                            <div class="col-span-full py-12 text-center text-gray-500 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                <p class="mt-2 font-bold text-gray-900">Belum ada warna</p>
                            </div>
                        @endforelse
                    </div>
                </div>    
            </div>
    
            <!-- Pagination Sementara -->
            <!-- <div class="shrink-0 flex items-center justify-center gap-2 pt-7 pb-2">
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
            </div> -->
            <div class="mt-4"> {{-- Sesuaikan margin --}}
                {{ $colors->links('vendor.pagination.custome-verso') }}
            </div>
        </div>  
    </div>
