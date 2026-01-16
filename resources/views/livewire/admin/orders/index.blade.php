<div class="flex flex-col h-full gap-3">

    @if($isModalOpen && $selectedOrder)
        @include('sections.admin.orders.modal-detail-order')
    @endif

    <div class="bg-white w-full py-3 px-5 rounded-sm shadow-sm shrink-0">
        @include('sections.admin.orders.orders-control')
    </div>

    <div class="flex flex-col flex-1 mt-1 bg-white w-full py-3 px-5 rounded-sm shadow-sm overflow-hidden">
        <div class="flex-1 overflow-y-auto px-5 pt-3">
            <div class="w-full overflow-x-auto">
                @include('sections.admin.orders.orders-table')
            </div>    
        </div>
    
        <div class="mt-4"> 
            {{ $orders->links('vendor.pagination.custome-verso') }}
        </div>
    </div>  
</div>