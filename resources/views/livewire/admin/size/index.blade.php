
    <div class="flex flex-col h-full gap-3">

        <!-- section create color -->

        @if($isModalOpen)
            @include('sections.admin.sizes.modal-form-size')
        @endif

        <!-- Sections Color-Controls) -->
        <div class="bg-white w-full py-3 px-5 rounded-sm shadow-sm shrink-0">
            @include('sections.admin.sizes.size-control')
        </div>
        <!-- Sections Size Card -->
        <div class="flex flex-col flex-1 mt-1 bg-white w-full py-3 px-5 rounded-sm shadow-sm overflow-hidden">
            <div class="flex-1 overflow-y-auto px-5 pt-3">
                <div class="w-full overflow-x-auto">
                    <div class="grid grid-cols-4 gap-5 gap-y-10">
                        @forelse($sizes as $size)
                            @include('sections.admin.sizes.size-card', ['color' => $size])
                        @empty
                            <div class="col-span-full py-12 text-center text-gray-500 border-2 border-dashed border-gray-200 rounded-xl bg-gray-50">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                <p class="mt-2 font-bold text-gray-900">Belum ada size</p>
                            </div>
                        @endforelse
                    </div>
                </div>    
            </div>
    
            <!-- Pagination  -->
            <div class="mt-4">
                {{ $sizes->links('vendor.pagination.custome-verso') }}
            </div>
        </div>  
    </div>
