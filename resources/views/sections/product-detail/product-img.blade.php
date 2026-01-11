<div class="space-y-4">
    <div class="aspect-square bg-gray-50 rounded-sm overflow-hidden">
        <img src="https://placehold.co/500x500" alt="Product" class="w-full h-full object-cover">
    </div>
    
    <div class="grid grid-cols-4 gap-2">
        @for ($i = 0; $i < 4; $i++)
            <button class="aspect-square rounded-sm border-2 {{ $i == 0 ? 'border-[#6B4F3B]' : 'border-transparent' }} overflow-hidden hover:border-[#6B4F3B] transition-all">
                <img src="https://placehold.co/150x150" class="w-full h-full object-cover">
            </button>
        @endfor
    </div>
</div>