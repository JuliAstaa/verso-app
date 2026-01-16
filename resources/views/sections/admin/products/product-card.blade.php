<tr class="hover:bg-gray-50 transition-colors group">
    
    {{-- 1. Checkbox --}}
    <td class="px-6 py-4">
        <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-[#5B4636] focus:ring-[#5B4636]">
    </td>

    {{-- 2. Product Name & Image --}}
    <td class="px-4 py-4">
        <div class="flex items-center gap-3">
            {{-- Gambar Kecil --}}
            <div class="w-10 h-10 rounded-lg bg-gray-100 overflow-hidden border border-gray-200 shrink-0">
                @if($product->images->count() > 0)
                    <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400 text-[10px]">No Img</div>
                @endif
            </div>
            
            {{-- Nama & SKU --}}
            <div class="flex flex-col">
                <span class="font-bold text-gray-800 text-sm line-clamp-1 group-hover:text-[#5B4636] transition-colors">
                    {{ $product->name }}
                </span>
                <span class="text-[10px] text-gray-400 font-mono">
                    {{ $product->variants->first()->sku ?? 'NO-SKU' }}
                </span>
            </div>
        </div>
    </td>

    {{-- 3. Category --}}
    <td class="px-4 py-4">
        <span class="bg-gray-100 text-gray-600 text-[10px] font-bold px-2.5 py-1 rounded-full border border-gray-200">
            {{ $product->category->name ?? 'Uncategorized' }}
        </span>
    </td>

    {{-- 4. Price --}}
    <td class="px-4 py-4 text-center text-sm font-medium text-gray-600 font-mono">
        Rp {{ number_format($product->base_price, 0, ',', '.') }}
    </td>

    {{-- 5. Stock (Total dari semua varian) --}}
    <td class="px-4 py-4 text-center">
        @php $totalStock = $product->variants->sum('stock'); @endphp
        @if($totalStock > 0)
            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-2 py-1 rounded-md">
                {{ $totalStock }} Item
            </span>
        @else
            <span class="text-xs font-bold text-red-600 bg-red-50 px-2 py-1 rounded-md">
                Habis
            </span>
        @endif
    </td>

    {{-- 6. Status --}}
    <td class="px-4 py-4 text-center">
        <div class="flex justify-center">
            <label class="relative inline-flex items-center cursor-pointer">
                <input wire:click="toggleStatus({{ $product->id }})" type="checkbox" class="sr-only peer" @if($product->is_active) checked @endif>
                <div class="w-8 h-4 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-3 after:w-3 after:transition-all peer-checked:bg-[#5B4636]"></div>
            </label>
        </div>
    </td>

    {{-- 7. Action --}}
    <td class="px-4 py-4 text-center">
        <div class="flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
            <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="p-1.5 text-gray-400 hover:text-[#5B4636] hover:bg-[#5B4636]/10 rounded-lg transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
            </a>
            <button wire:click="confirmDelete({{ $product->id }})" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            </button>
        </div>
    </td>
</tr>