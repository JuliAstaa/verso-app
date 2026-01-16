<div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
    <div>
        <h2 class="text-lg font-bold text-gray-800">Order Transactions</h2>
        <p class="text-xs text-gray-400">Pantau semua transaksi masuk dan status pengiriman.</p>
    </div>
    
    <div class="flex flex-wrap gap-2 items-center">
        
        {{-- Filter Status --}}
        <div class="relative">
            <select wire:model.live="filterStatus" class="appearance-none bg-gray-50 border border-gray-200 rounded-lg py-2 pl-3 pr-8 text-xs font-bold text-gray-600 focus:outline-none focus:ring-1 focus:ring-[#5B4636] cursor-pointer">
                <option value="">All Status</option>
                <option value="pending">⏳ Pending</option>
                <option value="paid">💰 Paid</option>
                <option value="shipped">🚚 Shipped</option>
                <option value="completed">✅ Completed</option>
                <option value="cancelled">❌ Cancelled</option>
            </select>
            <div class="absolute right-2 top-2.5 pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </div>
        </div>

        {{-- Sort --}}
        <div class="relative">
            <select wire:model.live="sortBy" class="appearance-none bg-gray-50 border border-gray-200 rounded-lg py-2 pl-3 pr-8 text-xs font-bold text-gray-600 focus:outline-none focus:ring-1 focus:ring-[#5B4636] cursor-pointer">
                <option value="latest">Latest Date</option>
                <option value="oldest">Oldest Date</option>
            </select>
             <div class="absolute right-2 top-2.5 pointer-events-none text-gray-400">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
            </div>
        </div>

        {{-- Search Input --}}
        <div class="relative">
            <input wire:model.live="search" type="text" placeholder="Search Invoice / Name..." 
                   class="pl-9 pr-4 py-2 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#5B4636] focus:ring-1 focus:ring-[#5B4636] w-full sm:w-64 transition-all">
            <div class="absolute left-3 top-2.5 text-gray-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
        </div>
    </div>
</div>