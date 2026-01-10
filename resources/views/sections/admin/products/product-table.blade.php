<div class="w-full overflow-x-auto">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="border-b border-gray-100 uppercase text-[12px] font-bold text-brand-700 tracking-wider">
                <th class="px-6 py-4">
                    <input type="checkbox" class="w-4 h-4 rounded border-brand-300 cursor-pointer">
                </th>
                <th class="px-4 py-4">Product Name</th>
                <th class="px-4 py-4 text-center">Price</th>
                <th class="px-4 py-4 text-center">Stock</th>
                <th class="px-4 py-4">Category</th>
                <th class="px-4 py-4">Brand</th>
                <th class="px-4 py-4">Status</th>
                <th class="px-4 py-4 text-center">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y divide-gray-50">
            @php
                $products = [
                    ['name' => 'Gabriela Cashmere Blazer', 'sku' => 'T14116', 'price' => 113.99, 'stock' => 1113, 'category' => 'Jacket', 'brand' => 'Loewe', 'status' => 'Active', 'img' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?w=100&q=80'],
                    ['name' => 'Loewe Blend Jacket', 'sku' => 'T14117', 'price' => 150.00, 'stock' => 5, 'category' => 'Jacket', 'brand' => 'Loewe', 'status' => 'Low Stock', 'img' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=100&q=80'],
                    ['name' => 'Sandro Jacket Black', 'sku' => 'T14118', 'price' => 210.50, 'stock' => 407, 'category' => 'Jacket', 'brand' => 'Sandro', 'status' => 'Active', 'img' => 'https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?w=100&q=80'],
                    ['name' => 'Adidas Stella McCartney', 'sku' => 'T14119', 'price' => 89.99, 'stock' => 0, 'category' => 'Sportswear', 'brand' => 'Adidas', 'status' => 'Out of Stock', 'img' => 'https://images.unsplash.com/photo-1518002171953-a080ee817e1f?w=100&q=80'],
                ];
            @endphp

            @foreach($products as $product)
            <tr class="hover:bg-brand-100 transition-all duration-200">
                <td class="px-6 py-4">
                    <input type="checkbox" class="w-4 h-4 rounded border-brand-300 cursor-pointer">
                </td>
                <td class="px-4 py-4">
                    <div class="flex items-center gap-3">
                        <div class="w-11 h-11 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0 border border-gray-100 shadow-sm">
                            <img src="{{ $product['img'] }}" alt="product" class="w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[13px] font-bold text-gray-800 leading-tight">{{ $product['name'] }}</span>
                            <span class="text-[11px] text-gray-400 mt-0.5 font-medium italic">SKU: {{ $product['sku'] }}</span>
                        </div>
                    </div>
                </td>
                <td class="px-4 py-4 text-center">
                    <span class="text-[13px] font-bold text-gray-700">${{ number_format($product['price'], 2) }}</span>
                </td>
                <td class="px-4 py-4 text-center">
                    <span class="text-[13px] font-medium {{ $product['stock'] < 10 ? 'text-red-500 font-bold' : 'text-gray-600' }}">
                        {{ number_format($product['stock']) }}
                    </span>
                </td>
                <td class="px-4 py-4">
                    <span class="text-[12px] text-gray-600 bg-gray-100 px-2 py-1 rounded">{{ $product['category'] }}</span>
                </td>
                <td class="px-4 py-4 text-[12px] font-medium text-gray-500">
                    {{ $product['brand'] }}
                </td>
                <td class="px-4 py-4">
                    @php
                        $statusClasses = [
                            'Active' => 'bg-green-50 text-green-600 border-green-100 dot-bg-green-500',
                            'Low Stock' => 'bg-orange-50 text-orange-600 border-orange-100 dot-bg-orange-500',
                            'Out of Stock' => 'bg-red-50 text-red-600 border-red-100 dot-bg-red-500',
                        ];
                        $currentClass = $statusClasses[$product['status']] ?? 'bg-gray-50 text-gray-600 border-gray-100 dot-bg-gray-500';
                    @endphp

                    <div class="inline-flex items-center gap-1.5 py-1 px-2.5 rounded-full border {{ explode(' dot-bg-', $currentClass)[0] }} text-[11px] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full {{ 'bg-' . explode(' dot-bg-', $currentClass)[1] }}"></span>
                        {{ $product['status'] }}
                    </div>
                </td>
                <td class="px-4 py-4">
                    <div class="flex items-center justify-center gap-2">
                        <button title="Edit Product" class="p-2 text-brand-500 hover:bg-brand-500 hover:text-white rounded-lg transition-all border border-transparent hover:border-brand-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                        </button>
                        <button title="Delete Product" class="p-2 text-red-500 hover:bg-red-500 hover:text-white rounded-lg transition-all border border-transparent hover:border-red-600 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>