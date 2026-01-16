<div class="space-y-4 mb-8">
    {{-- Balance --}}
    <div class="flex items-center justify-between text-left">
        <div class="flex items-center space-x-3">
            <span class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center text-orange-600 font-bold text-xs">B</span>
            <span class="text-sm font-medium text-gray-600">Balance</span>
        </div>
        <span class="text-sm font-bold">Rp0</span>
    </div>

    <hr class="border-gray-200">

    {{-- GoPay --}}
    <div class="flex items-center justify-between text-left">
        <div class="flex items-center space-x-3">
            <span class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xs">G</span>
            <span class="text-sm font-medium text-gray-600">GoPay</span>
        </div>
        <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" class="sr-only peer" checked>
            <div class="w-11 h-6 bg-gray-400 rounded-full peer peer-checked:after:translate-x-full peer-checked:bg-brand-500 after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
        </label>
    </div>

    {{-- Manage Button --}}
    <div class="mt-8"> {{-- Kita bungkus div untuk kontrol margin --}}
        <x-button 
            variant="outline" 
            @click="showModal = true"
            class="w-full flex items-center justify-center space-x-2 border-dashed !border-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            <span>Manage Payment</span>
        </x-button>
    </div>
</div>