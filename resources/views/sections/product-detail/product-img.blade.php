<div class="space-y-4">
    <div class="aspect-square bg-gray-50 rounded-sm overflow-hidden">
        @if($product->image_url)
            <img src="{{ $currentVariant->image_url ?? $product->image_url }}" 
                alt="{{ $product->name }}" 
                class="w-full h-full object-cover">
        
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-md p-2">
                No Image
            </div>
        @endif
    </div>
</div>