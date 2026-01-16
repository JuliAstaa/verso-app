<div class="w-full p-6 space-y-8">
    
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 border-b border-gray-100 pb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">Pusat Laporan 🗂️</h1>
            <p class="text-sm text-gray-500 mt-1">Export data operasional toko ke Excel atau PDF.</p>
        </div>
    </div>

    {{-- GRID 4 KOLOM --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 items-start">
        
        {{-- CARD 1: PENJUALAN (HIJAU 🟢) --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
            <div class="p-5 border-b border-gray-100 bg-green-50/50 flex items-center gap-4">
                <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Penjualan</h3>
                    <p class="text-[10px] text-gray-500 uppercase font-bold">Revenue & Omzet</p>
                </div>
            </div>
            <div class="p-5 flex-1 space-y-4">
                {{-- Input Tanggal --}}
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Periode</label>
                    <div class="flex items-center gap-2">
                        <input wire:model="startDate" type="date" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2">
                        <span class="text-gray-400">-</span>
                        <input wire:model="endDate" type="date" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2">
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 grid grid-cols-2 gap-3">
                <button wire:click="downloadReport('revenue', 'xlsx')" class="flex justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg transition shadow-sm">Excel</button>
                <button wire:click="downloadReport('revenue', 'pdf')" class="flex justify-center gap-2 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition shadow-sm">PDF</button>
            </div>
        </div>

        {{-- CARD 2: PRODUK TERLARIS (BIRU 🔵) --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
            <div class="p-5 border-b border-gray-100 bg-blue-50/50 flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Produk Terlaris</h3>
                    <p class="text-[10px] text-gray-500 uppercase font-bold">Top Selling Items</p>
                </div>
            </div>
            <div class="p-5 flex-1 space-y-4">
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Periode</label>
                    <div class="flex items-center gap-2">
                        <input wire:model="startDate" type="date" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2">
                        <span class="text-gray-400">-</span>
                        <input wire:model="endDate" type="date" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2">
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 grid grid-cols-2 gap-3">
                <button wire:click="downloadReport('products', 'xlsx')" class="flex justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg transition shadow-sm">Excel</button>
                <button wire:click="downloadReport('products', 'pdf')" class="flex justify-center gap-2 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition shadow-sm">PDF</button>
            </div>
        </div>

        {{-- CARD 3: STOK GUDANG (ORANGE 🟠) --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group h-full">
            
            <div class="p-5 border-b border-gray-100 bg-orange-50/50 flex items-center gap-4">
                <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-lg flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Laporan Stok</h3>
                    <p class="text-[10px] text-gray-500 uppercase font-bold">Inventory Status</p>
                </div>
            </div>

            {{-- BODY YANG DIBENERIN BIAR RATA --}}
            <div class="p-5 flex-1 space-y-4 flex flex-col justify-center"> {{-- Tambah flex-col justify-center biar konten di tengah --}}
                <div class="space-y-1 opacity-50 cursor-not-allowed">
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Periode (Snapshot)</label>
                    <div class="flex items-center gap-2">
                        <input type="text" disabled value="Real-time Data" class="w-full bg-gray-100 border border-gray-200 text-xs text-center font-bold text-gray-400 rounded-lg p-2 cursor-not-allowed">
                    </div>
                </div>
            </div>

            <div class="p-4 bg-gray-50 border-t border-gray-100 grid grid-cols-2 gap-3">
                <button wire:click="downloadReport('stock', 'xlsx')" class="flex justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg transition shadow-sm">Excel</button>
                <button wire:click="downloadReport('stock', 'pdf')" class="flex justify-center gap-2 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition shadow-sm">PDF</button>
            </div>
        </div>

        {{-- CARD 4: TOP CUSTOMER (UNGU 🟣) --}}
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col group">
            <div class="p-5 border-b border-gray-100 bg-purple-50/50 flex items-center gap-4">
                <div class="w-10 h-10 bg-purple-100 text-purple-600 rounded-lg flex items-center justify-center shadow-inner group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Pelanggan Loyal</h3>
                    <p class="text-[10px] text-gray-500 uppercase font-bold">Top Spenders</p>
                </div>
            </div>
            <div class="p-5 flex-1 space-y-4">
                <div class="space-y-1">
                    <label class="text-[10px] font-bold text-gray-400 uppercase">Periode</label>
                    <div class="flex items-center gap-2">
                        <input wire:model="startDate" type="date" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2">
                        <span class="text-gray-400">-</span>
                        <input wire:model="endDate" type="date" class="w-full bg-gray-50 border border-gray-200 text-xs rounded-lg p-2">
                    </div>
                </div>
            </div>
            <div class="p-4 bg-gray-50 border-t border-gray-100 grid grid-cols-2 gap-3">
                <button wire:click="downloadReport('customers', 'xlsx')" class="flex justify-center gap-2 px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold rounded-lg transition shadow-sm">Excel</button>
                <button wire:click="downloadReport('customers', 'pdf')" class="flex justify-center gap-2 px-3 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded-lg transition shadow-sm">PDF</button>
            </div>
        </div>

    </div>
</div>