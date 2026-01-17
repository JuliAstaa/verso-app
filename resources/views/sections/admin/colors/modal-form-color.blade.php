<div 
    class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div 
        class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden transform transition-all scale-100"
        x-click.away="$wire.set('isModalOpen', false)" 
    >
        <div class="pt-8 pb-6 text-center">
            <h2 class="text-2xl font-bold text-gray-800 tracking-tight">{{ $colorId ? 'Edit Color' : 'New Color' }}</h2>
            <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">{{ $colorId ? 'Update Color Details' : 'Add New Color Variation' }}</p>
        </div>

        <div class="px-8 pb-8 space-y-5">
            
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">
                    Color Name
                </label>
                <input 
                    wire:model="name" 
                    type="text" 
                    placeholder="e.g. Midnight Blue"
                    class="w-full bg-gray-50 text-gray-900 text-sm rounded-xl border-none focus:ring-2 focus:ring-[#5B4636]/20 focus:bg-white block p-4 shadow-sm placeholder-gray-300 transition-all"
                >
                @error('name') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">
                    Hex Code
                </label>
                <div class="relative flex items-center">    
                    <input 
                        wire:model.blur="hex_code" 
                        type="text" 
                        placeholder="#000000" 
                        class="w-full bg-gray-50 text-gray-900 text-sm rounded-xl border-none focus:ring-2 focus:ring-[#5B4636]/20 focus:bg-white block py-4 pl-4 pr-4 shadow-sm placeholder-gray-300 transition-all uppercase font-mono"
                        maxlength="7"
                    >
                </div>
                @error('hex_code') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
            </div>

            @if(session('error'))
                <div class="bg-red-50 text-red-600 text-xs p-3 rounded-lg text-center">
                    {{ session('error') }}
                </div>
            @endif

            <div class="pt-2 space-y-3">
                <x-btn-loading 
                    action="save()" 
                    loadingText="Saving..." 
                    class="w-full bg-[#5B4636] text-white font-bold py-3 rounded-xl hover:bg-[#433025] shadow-lg mb-4 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ $colorId ? 'Save Changes' : 'Create Color' }}
                </x-btn-loading>

                <button 
                    wire:click="cancel" 
                    class="w-full text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 hover:text-gray-700 font-semibold rounded-xl text-sm px-5 py-3.5 text-center transition-colors cursor-pointer"
                >
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>