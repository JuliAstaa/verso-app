<div class="flex flex-col h-full gap-3">

    <div class="bg-white w-full py-3 px-5 rounded-sm shadow-sm shrink-0">
        @include('sections.admin.customers.customers-control')
    </div>

    <div class="flex flex-col flex-1 mt-1 bg-white w-full py-3 px-5 rounded-sm shadow-sm overflow-hidden">
        <div class="flex-1 overflow-y-auto px-5 pt-3">
            <div class="w-full overflow-x-auto">
                {{-- Panggil Table disini --}}
                @include('sections.admin.customers.customers-table')
            </div>    
        </div>
    
        <div class="mt-4"> 
            {{ $customers->links('vendor.pagination.custome-verso') }}
        </div>
    </div>  
</div>