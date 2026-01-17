<div class="space-y-4">
    <div class="aspect-square bg-gray-50 rounded-sm overflow-hidden">
        @php
            $mainImage = $product->images->first();
        @endphp
        @if($mainImage)
            <img src="{{ Storage::url($mainImage->image_path) }}" 
                alt="{{ $product->name }}" 
                class="w-full h-full object-cover">
        
        @else
            <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-md p-2">
                No Image
            </div>
        @endif
    </div>
</div>