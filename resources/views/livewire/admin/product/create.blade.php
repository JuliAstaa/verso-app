<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Produk Baru</h1>
            <p class="text-sm text-gray-500">Isi detail produk lengkap dengan varian.</p>
        </div>
        <a href="{{ route('admin.products.index') }}" wire:navigate class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 text-sm font-bold hover:bg-gray-50">
            &larr; Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Dasar</h3>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Produk</label>
                        <input wire:model="name" type="text" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#5B4636]/20" placeholder="Nama Produk...">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Deskripsi</label>
                        <textarea wire:model="description" rows="5" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#5B4636]/20" placeholder="Deskripsi lengkap..."></textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-800">Varian Produk</h3>
                    <button wire:click="generateVariants" class="bg-[#5B4636] text-white text-xs font-bold px-3 py-2 rounded-lg hover:bg-[#433025]">
                        GENERATE
                    </button>
                </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-6">

                <div class="space-y-3">
                    <label class="block text-xs font-bold text-gray-500 uppercase">Pilih Warna</label>
                    

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

                    <!-- search  bar -->
                    <div class="relative group">
         
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#5B4636] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                   
                        <input 
                            wire:model.live.debounce.300ms="searchColor" 
                            type="text" 
                            placeholder="Cari warna..." 
                            class="block w-full pl-10 pr-4 py-2.5 
                                bg-gray-50 border border-gray-200 rounded-xl 
                                text-sm text-gray-700 placeholder-gray-400
                                focus:ring-2 focus:ring-[#5B4636]/20 focus:border-[#5B4636] focus:bg-white
                                transition-all duration-200 ease-in-out shadow-sm"
                        >
                    </div>

                    <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-3 bg-white shadow-inner custom-scrollbar">
                        <div class="flex flex-wrap gap-2">
                            @forelse($colors as $color)
                                <label class="cursor-pointer relative group">
                                    <input type="checkbox" wire:model.live="selectedColors" value="{{ $color->id }}" class="peer sr-only">
                                    
                                    {{-- Style Tombol Warna --}}
                                    <div class="px-3 py-1.5 text-xs font-medium border border-gray-200 rounded-lg 
                                                text-gray-600 bg-gray-50 hover:bg-gray-100 hover:border-gray-300 
                                                peer-checked:bg-[#5B4636] peer-checked:text-white peer-checked:border-[#5B4636] 
                                                peer-checked:ring-2 peer-checked:ring-[#5B4636]/30 transition-all select-none">
                                        {{ $color->name }}
                                    </div>
                                </label>
                            @empty
                                <p class="text-xs text-gray-400 p-2 text-center w-full">Warna tidak ditemukan.</p>
                            @endforelse
                        </div>
                    </div>
                </div>


                {{-- === KOLOM 2: SIZE (Sama Logicnya) === --}}
                <div class="space-y-3">
                    <label class="block text-xs font-bold text-gray-500 uppercase">Pilih Size</label>
                    
                    {{-- SELECTED SIZE --}}
                    @if(!empty($selectedSizes))
                        <div class="flex flex-wrap gap-2 mb-2 p-3 bg-gray-50 rounded-xl border border-gray-100 min-h-[50px]">
                            @foreach($selectedSizes as $id)
                                @php $sizeCode = \App\Models\Size::find($id)->code ?? '?'; @endphp
                                <button wire:click="removeSize({{ $id }})" 
                                        class="flex items-center gap-2 px-3 py-1 bg-[#5B4636] text-white text-xs rounded-full hover:bg-red-500 transition-colors group">
                                    {{ $sizeCode }}
                                    
                                </button>
                            @endforeach
                        </div>
                    @endif

                    {{-- SEARCH BAR --}}
                    <!-- search  bar -->
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400 group-focus-within:text-[#5B4636] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>

                        <input 
                            wire:model.live.debounce.300ms="searchSize" 
                            type="text" 
                            placeholder="Cari size..." 
                            class="block w-full pl-10 pr-4 py-2.5 
                                bg-gray-50 border border-gray-200 rounded-xl 
                                text-sm text-gray-700 placeholder-gray-400
                                focus:ring-2 focus:ring-[#5B4636]/20 focus:border-[#5B4636] focus:bg-white
                                transition-all duration-200 ease-in-out shadow-sm"
                        >
                    </div>

                    {{-- LIST SIZE --}}
                    <div class="max-h-48 overflow-y-auto border border-gray-200 rounded-xl p-3 bg-white shadow-inner custom-scrollbar">
                        <div class="flex flex-wrap gap-2">
                            @forelse($sizes as $size)
                                <label class="cursor-pointer relative">
                                    <input type="checkbox" wire:model.live="selectedSizes" value="{{ $size->id }}" class="peer sr-only">
                                    <div class="w-10 h-8 flex items-center justify-center text-xs font-bold border border-gray-200 rounded-lg 
                                                text-gray-600 bg-gray-50 hover:bg-gray-100 
                                                peer-checked:bg-[#5B4636] peer-checked:text-white peer-checked:border-[#5B4636] 
                                                peer-checked:ring-2 peer-checked:ring-[#5B4636]/30 transition-all select-none">
                                        {{ $size->code }}
                                    </div>
                                </label>
                            @empty
                                <p class="text-xs text-gray-400 p-2 text-center w-full">Size kosong.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>

                @if(!empty($variants))
                    <div class="overflow-x-auto border border-gray-200 rounded-xl">
                        <table class="w-full text-xs text-left">
                            <thead class="bg-gray-50 uppercase font-bold text-gray-500">
                                <tr>
                                    <th class="px-4 py-2">Varian</th>
                                    <th class="px-4 py-2">Harga</th>
                                    <th class="px-4 py-2">Stok</th>
                                    <th class="px-4 py-2">Hapus</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($variants as $index => $variant)
                                    <tr>
                                        <td class="px-4 py-2 font-bold">{{ $variant['label_color'] }} - {{ $variant['label_size'] }}</td>
                                        <td class="px-4 py-2">
                                            <input type="number" wire:model="variants.{{ $index }}.price" class="w-24 bg-gray-50 border-gray-200 rounded px-2 py-1">
                                        </td>
                                        <td class="px-4 py-2">
                                            <input type="number" wire:model="variants.{{ $index }}.stock" class="w-20 bg-gray-50 border-gray-200 rounded px-2 py-1">
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

        <div class="space-y-8">
            
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <button wire:click="save" class="w-full bg-[#5B4636] text-white font-bold py-3 rounded-xl hover:bg-[#433025] shadow-lg mb-4">
                    <span wire:loading.remove>Simpan Produk</span>
                    <span wire:loading>Menyimpan...</span>
                </button>
                
                <label class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="rounded text-[#5B4636] focus:ring-[#5B4636]">
                    <span class="text-sm font-bold text-gray-700">Status Aktif</span>
                </label>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 space-y-4">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Kategori</label>
                    <select wire:model="category_id" class="w-full bg-gray-50 border-none rounded-xl p-3 focus:ring-2 focus:ring-[#5B4636]/20 text-sm">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Harga Dasar</label>
                        <input wire:model="base_price" type="number" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Berat (gr)</label>
                        <input wire:model="weight" type="number" class="w-full bg-gray-50 border-none rounded-xl p-3 text-sm">
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-4">Galeri Produk</label>
                
                <div class="grid grid-cols-3 gap-2 mb-4">
                    @foreach($images as $img)
                        <div class="aspect-square rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ $img->temporaryUrl() }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                    
                    <label class="aspect-square flex flex-col items-center justify-center bg-gray-50 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:bg-gray-100">
                        <input type="file" wire:model="images" multiple class="hidden">
                        <span class="text-gray-400 text-xs">+ Foto</span>
                    </label>
                </div>
            </div>

        </div>

    </div>
</div>
