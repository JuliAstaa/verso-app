<div class="group flex flex-col bg-white border border-gray-100 rounded-2xl p-2 hover:shadow-xl hover:border-[#5B4636]/20 transition-all duration-300 relative">
    
    {{-- 1. KOTAK UTAMA (Image / Text Placeholder) --}}
    <div class="relative w-full aspect-square bg-[#F9F9F9] rounded-xl flex items-center justify-center overflow-hidden">
        
        @if($category->images && Storage::disk('public')->exists($category->images))
            {{-- A. Kalau Ada Gambar --}}
            <img 
                src="{{ asset('storage/' . $category->images) }}" 
                alt="{{ $category->name }}"
                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
            >
        @else
            {{-- B. Kalau Gak Ada Gambar (Teks Besar ala contohmu) --}}
            <span class="text-xl font-bold text-[#5B4636] tracking-tight opacity-50 group-hover:opacity-100 transition-opacity">
                {{ $category->name }}
            </span>
        @endif

        {{-- ACTION BUTTONS (Edit & Delete) --}}
        {{-- Muncul cuma pas di-Hover (Absolute Center) --}}
        <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-2 backdrop-blur-[2px]">
            
            {{-- Tombol Edit --}}
            
            <button 
                wire:click="edit({{ $category->id }})" 
                class="bg-white text-gray-500 hover:text-white hover:bg-brand-500 hover w-10 h-10 rounded-full flex items-center justify-center shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 delay-75 hover:scale-110 cursor-pointer"
                title="Edit Kategori"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
            </button>

            {{-- Tombol Delete --}}
            <button 
                wire:click="confirmDelete({{ $category->id }})" 
                class="bg-white text-gray-500 hover:text-white hover:bg-red-600 w-10 h-10 rounded-full flex items-center justify-center shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 delay-100 hover:scale-110 cursor-pointer"
                title="Hapus Kategori"
            >
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
            </button>
        </div>

        {{-- Badge Status (Pojok Kiri Atas) --}}
        @if(!$category->is_active)
            <div class="absolute top-2 left-2 bg-red-100 text-red-600 text-[10px] font-bold px-2 py-1 rounded-md shadow-sm">
                Non-Aktif
            </div>
        @endif
    </div>

    {{-- 2. TEKS BAWAH (Judul) --}}
    <div class="text-center pt-4 pb-2">
        <h3 class="font-bold text-gray-800 text-sm group-hover:text-[#5B4636] transition-colors truncate px-2">
            {{ $category->name }}
        </h3>
        {{-- Optional: Total Produk --}}
        {{-- <p class="text-[10px] text-gray-400 mt-0.5">{{ $category->products_count ?? 0 }} Items</p> --}}
    </div>
</div>