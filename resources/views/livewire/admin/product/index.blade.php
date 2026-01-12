
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
            <div class="mt-4"> 
                {{ $products->links('vendor.pagination.custome-verso') }}
            </div>
        </div>
    </div>