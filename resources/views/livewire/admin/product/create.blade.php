<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Add New Product</h1>
            <p class="text-sm text-gray-500">Fill in complete product details including variants.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" wire:navigate class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm font-bold hover:bg-gray-50">
            &larr; Back
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT COLUMN (MAIN CONTENT) --}}
        <div class="lg:col-span-2 space-y-8">
            
            {{-- 1. BASIC INFORMATION --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Basic Information</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Product Name</label>
                        <input wire:model="name" type="text" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#5B4636]/20 @error('name') ring-2 ring-red-500/50 bg-red-50 @enderror" placeholder="Product Name...">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Description</label>
                        <textarea wire:model="description" rows="5" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#5B4636]/20 @error('description') ring-2 ring-red-500/50 bg-red-50 @enderror" placeholder="Complete description..."></textarea>
                        @error('description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- 2. PRODUCT VARIANTS --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Product Variants</h3>
                    <button wire:click="generateVariants" class="bg-[#5B4636] text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-[#433025]">
                        GENERATE
                    </button>
                </div>

                {{-- VARIANT ERROR --}}
                @error('variants') 
                    <div class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded-lg border border-red-200">
                        {{ $message }} (Please select color & size then click Generate)
                    </div> 
                @enderror

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">
                    
                    {{-- SELECT COLOR --}}
                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-gray-500 uppercase">Select Color</label>

                        @if(!empty($selectedColors))
                            <div class="flex flex-wrap gap-2 mb-2 p-3 bg-gray-50 rounded-xl border border-gray-100 min-h-[50px]">
                                @foreach($selectedColors as $id)
                                    @php $colorName = \App\Models\Color::find($id)->name ?? 'Unknown'; @endphp
                                    <button wire:click="removeColor({{ $id }})" 
                                            class="flex items-center gap-2 px-3 py-1 bg-[#5B4636] text-white text-xs rounded-full hover:bg-red-500 transition-colors group">
                                            {{ $colorName }}
                                            <span class="bg-white/20 rounded-full p-0.5 group-hover:bg-white/40">&times;</span>
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#5B4636] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="searchColor" type="text" placeholder="Search color..." class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#5B4636]/20 focus:border-[#5B4636] transition-all shadow-sm">
                        </div>

                        <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-3 bg-white shadow-inner custom-scrollbar">
                            <div class="flex flex-wrap gap-2">
                                @forelse($colors as $color)
                                    <label class="cursor-pointer relative group">
                                        <input type="checkbox" wire:model.live="selectedColors" value="{{ $color->id }}" class="peer sr-only">
                                        <div class="px-3 py-1.5 text-xs font-medium border border-gray-200 rounded-lg text-gray-600 bg-gray-50 hover:bg-gray-100 peer-checked:bg-[#5B4636] peer-checked:text-white peer-checked:border-[#5B4636] transition-all select-none">
                                            {{ $color->name }}
                                        </div>
                                    </label>
                                @empty
                                    <p class="text-xs text-gray-400 p-2 text-center w-full">Color not found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    {{-- SELECT SIZE --}}
                    <div class="space-y-3">
                        <label class="block text-xs font-bold text-gray-500 uppercase">Select Size</label>
                        
                        @if(!empty($selectedSizes))
                            <div class="flex flex-wrap gap-2 mb-2 p-3 bg-gray-50 rounded-xl border border-gray-100 min-h-[50px]">
                                @foreach($selectedSizes as $id)
                                    @php $sizeCode = \App\Models\Size::find($id)->code ?? '?'; @endphp
                                    <button wire:click="removeSize({{ $id }})" class="flex items-center gap-2 px-3 py-1 bg-[#5B4636] text-white text-xs rounded-full hover:bg-red-500 transition-colors group">
                                            {{ $sizeCode }}
                                    </button>
                                @endforeach
                            </div>
                        @endif

                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#5B4636] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input wire:model.live.debounce.300ms="searchSize" type="text" placeholder="Search size..." class="block w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#5B4636]/20 focus:border-[#5B4636] transition-all shadow-sm">
                        </div>

                        <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-3 bg-white shadow-inner custom-scrollbar">
                            <div class="flex flex-wrap gap-2">
                                @forelse($sizes as $size)
                                    <label class="cursor-pointer relative">
                                        <input type="checkbox" wire:model.live="selectedSizes" value="{{ $size->id }}" class="peer sr-only">
                                        <div class="w-10 h-8 flex items-center justify-center text-xs font-bold border border-gray-200 rounded-lg text-gray-600 bg-gray-50 hover:bg-gray-100 peer-checked:bg-[#5B4636] peer-checked:text-white peer-checked:border-[#5B4636] transition-all select-none">
                                            {{ $size->code }}
                                        </div>
                                    </label>
                                @empty
                                    <p class="text-xs text-gray-400 p-2 text-center w-full">No sizes found.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                {{-- VARIANTS TABLE --}}
                @if(!empty($variants))
                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="w-full text-xs text-left">
                            <thead class="bg-gray-50 uppercase font-bold text-gray-500">
                                <tr>
                                    <th class="px-4 py-2">Variant</th>
                                    <th class="px-4 py-2">Price</th>
                                    <th class="px-4 py-2">Stock</th>
                                    <th class="px-4 py-2">Remove</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($variants as $index => $variant)
                                    <tr wire:key="variant-{{ $index }}">
                                        <td class="px-4 py-2 font-bold">{{ $variant['label_color'] }} - {{ $variant['label_size'] }}</td>
                                        
                                        {{-- INPUT PRICE --}}
                                        <td class="px-4 py-2">
                                            <input type="number" wire:model="variants.{{ $index }}.price" class="w-24 bg-gray-50 border-gray-200 rounded px-2 py-1 focus:ring-[#5B4636] @error('variants.'.$index.'.price') border-red-500 bg-red-50 @enderror">
                                            @error('variants.'.$index.'.price') <div class="text-[10px] text-red-500 mt-1">Required</div> @enderror
                                        </td>
                                        
                                        {{-- INPUT STOCK --}}
                                        <td class="px-4 py-2">
                                            <input type="number" wire:model="variants.{{ $index }}.stock" class="w-20 bg-gray-50 border-gray-200 rounded px-2 py-1 focus:ring-[#5B4636] @error('variants.'.$index.'.stock') border-red-500 bg-red-50 @enderror">
                                            @error('variants.'.$index.'.stock') <div class="text-[10px] text-red-500 mt-1">Required</div> @enderror
                                        </td>

                                        <td class="px-4 py-2">
                                            <button wire:click="removeVariant({{ $index }})" class="text-red-500 hover:text-red-700">&times;</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        {{-- RIGHT COLUMN (SIDEBAR) --}}
        <div class="space-y-8">
            
            {{-- SAVE BUTTON --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                 <x-btn-loading 
                    action="save()" 
                    loadingText="Saving..." 
                    class="w-full bg-[#5B4636] text-white font-bold py-3 rounded-xl hover:bg-[#433025] shadow-lg mb-4 disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    Save changes
                </x-btn-loading>
                
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="rounded text-[#5B4636] focus:ring-[#5B4636]">
                    <span class="text-sm font-bold text-gray-700">Active Status</span>
                </label>
            </div>

            {{-- 3. CATEGORY & BASE PRICE --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Category</label>
                    <select wire:model="category_id" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#5B4636]/20 text-sm @error('category_id') ring-2 ring-red-500/50 bg-red-50 @enderror">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Base Price</label>
                        <input wire:model="base_price" type="number" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm @error('base_price') ring-2 ring-red-500/50 bg-red-50 @enderror">
                        @error('base_price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Weight (gr)</label>
                        <input wire:model="weight" type="number" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm @error('weight') ring-2 ring-red-500/50 bg-red-50 @enderror">
                        @error('weight') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- 4. PRODUCT GALLERY --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-4">Product Gallery</label>
                
                @error('images') <span class="text-red-500 text-xs mb-2 block">{{ $message }}</span> @enderror
                @error('images.*') <span class="text-red-500 text-xs mb-2 block">{{ $message }}</span> @enderror

                <div class="grid grid-cols-3 gap-2 mb-4">
                    @foreach($images as $img)
                        <div class="aspect-square rounded-lg overflow-hidden border border-gray-200 relative group">
                            <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                    
                    {{-- UPLOAD LABEL (ALPINE JS) --}}
                    <label 
                        x-data="{ isUploading: false, progress: 0 }"
                        x-on:livewire-upload-start="isUploading = true"
                        x-on:livewire-upload-finish="isUploading = false"
                        x-on:livewire-upload-error="isUploading = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress"

                        class="aspect-square flex flex-col items-center justify-center bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100 relative overflow-hidden @error('images') border-red-500 bg-red-50 @enderror"
                    >
                        <input type="file" wire:model="images" multiple class="hidden" accept="image/png, image/jpeg, image/jpg, image/webp">
                        
                        {{-- NORMAL STATE (+ Photo) --}}
                        <div x-show="!isUploading" class="flex flex-col items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            <span class="text-gray-400 text-xs mt-1">+ Photo</span>
                        </div>

                        {{-- UPLOADING STATE --}}
                        <div x-show="isUploading" style="display: none;" class="flex flex-col items-center w-full px-2">
                            <svg class="animate-spin h-5 w-5 text-[#5B4636] mb-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            
                            <div class="text-xs text-[#5B4636] font-bold">Uploading...</div>
                            
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                <div class="bg-[#5B4636] h-1.5 rounded-full transition-all duration-300" :style="'width: ' + progress + '%'"></div>
                            </div>
                            <div class="text-[10px] text-gray-500 mt-1" x-text="progress + '%'"></div>
                        </div>
                    </label>
                </div>
                <p class="text-[10px] text-gray-400">Support: JPG, PNG, WEBP, SVG (Max 2MB)</p>
            </div>

        </div>

    </div>
</div>