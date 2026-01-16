<div class="w-full overflow-x-auto bg-white rounded-xl border border-gray-100 shadow-sm">
    <table class="w-full text-left border-collapse">
        
        {{-- HEADERS --}}
        <thead class="bg-gray-50">
            <tr class="border-b border-gray-100 uppercase text-[11px] font-bold text-gray-500 tracking-wider">
                <th class="px-6 py-4 rounded-tl-xl">
                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#5B4636] focus:ring-[#5B4636]">
                </th>
                <th class="px-4 py-4">Product Name</th>
                <th class="px-4 py-4">Category</th>
                <th class="px-4 py-4 text-center">Price</th>
                <th class="px-4 py-4 text-center">Stock</th>
                <th class="px-4 py-4 text-center">Status</th>
                <th class="px-4 py-4 text-center rounded-tr-xl">Action</th>
            </tr>
        </thead>

        {{-- BODY --}}
        <tbody class="divide-y divide-gray-50">
            
            @forelse($products as $product)
                {{-- Panggil File Row Terpisah (Biar Rapi) --}}
                @include('sections.admin.products.product-card', ['product' => $product])
            
            @empty
                {{-- TAMPILAN KOSONG (Pakai Colspan biar lebar) --}}
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center justify-center space-y-3">
                            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="text-gray-900 font-bold">Belum ada produk</p>
                                <p class="text-gray-400 text-xs">Mulai tambahkan produk pertamamu!</p>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforelse

        </tbody>
    </table>
</div>