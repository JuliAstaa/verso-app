<div 
    class="fixed inset-0 z-50 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4"
    x-transition
>
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden" x-click.away="$wire.set('isModalOpen', false)">
        
        {{-- Header --}}
        <div class="pt-8 pb-4 text-center">
            <h2 class="text-2xl font-bold text-gray-800">
                {{ $categoryId ? 'Edit Kategori' : 'Kategori Baru' }}
            </h2>
        </div>

        <div class="px-8 pb-8 space-y-6">
            
            {{-- 1. Input Nama --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">Nama Kategori</label>
                <input 
                    wire:model="name" 
                    type="text" 
                    class="w-full bg-gray-50 text-gray-900 text-sm rounded-xl border-none focus:ring-2 focus:ring-[#5B4636]/20 block p-4 shadow-sm"
                    placeholder="Masukkan nama kategori..."
                >
                @error('name') <span class="text-red-500 text-xs mt-1 ml-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- 2. Input Gambar (SIMPLE VERSION) --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">Gambar Cover</label>
                
                <div class="flex items-center gap-4">
                    {{-- Preview Gambar --}}
                    <div class="shrink-0 w-24 h-24 bg-gray-100 rounded-xl overflow-hidden border border-gray-200">
                        @if ($newImage)
                            <img src="{{ $newImage->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif ($oldImage)
                            <img src="{{ asset('storage/' . $oldImage) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                            </div>
                        @endif
                    </div>

                    {{-- Tombol Upload Biasa --}}
                    <div class="flex-1">
                        <input 
                            type="file" 
                            wire:model="newImage"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#5B4636]/10 file:text-[#5B4636] hover:file:bg-[#5B4636]/20 cursor-pointer"
                            accept="image/*"
                        >
                        <p class="mt-1 text-[10px] text-gray-400">PNG, JPG (Max. 2MB)</p>
                        @error('newImage') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            {{-- 3. Status Toggle --}}
            <div class="flex items-center justify-between bg-gray-50 p-4 rounded-xl">
                <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Status Aktif</span>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input wire:model="is_active" type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#5B4636]"></div>
                </label>
            </div>

            {{-- Tombol Action --}}
            <div class="pt-2 space-y-3">
                <button 
                    wire:click="save"
                    {{-- Loading cuma buat disable tombol biar ga double klik, teks ga berubah --}}
                    wire:loading.attr="disabled"
                    class="w-full text-white bg-[#5B4636] hover:bg-[#433025] font-bold rounded-xl text-sm px-5 py-4 text-center shadow-lg transition-all disabled:opacity-50 disabled:cursor-not-allowed"
                >
                    {{ $categoryId ? 'Simpan Perubahan' : 'Buat Kategori' }}
                </button>

                <button 
                    wire:click="resetForm" 
                    class="w-full text-gray-500 bg-white border border-gray-200 hover:bg-gray-50 font-semibold rounded-xl text-sm px-5 py-3.5 transition-colors"
                >
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>