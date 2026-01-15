<div x-show="openAddAddress" 
     x-effect="openAddAddress ? document.body.classList.add('overflow-hidden') : document.body.classList.remove('overflow-hidden')"
     class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" 
     x-cloak>
    
    <div @click.away="openAddAddress = false" 
         class="bg-white rounded-3xl max-w-2xl w-full overflow-hidden flex flex-col border border-gray-100">
        
        {{-- Header Modal --}}
        <div class="px-8 py-6 flex justify-between items-start relative">
            <div class="w-full text-center">
                <h3 class="font-bold text-gray-900 text-2xl">Tambah Alamat</h3>
                
                {{-- Stepper UI --}}
                <div class="flex items-center justify-center mt-8 px-10">
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center text-sm font-bold">1</div>
                        <span class="text-[10px] mt-2 text-gray-800 font-medium">Cari lokasi pengirimanmu</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-gray-200 -mt-6"></div>
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-8 h-8 rounded-full border-2 border-gray-200 bg-white text-gray-400 flex items-center justify-center text-sm font-bold">2</div>
                        <span class="text-[10px] mt-2 text-gray-400">Tentukan pinpoint lokasi</span>
                    </div>
                    <div class="flex-1 h-[2px] bg-gray-200 -mt-6"></div>
                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-8 h-8 rounded-full border-2 border-gray-200 bg-white text-gray-400 flex items-center justify-center text-sm font-bold">3</div>
                        <span class="text-[10px] mt-2 text-gray-400">Lengkapi detail alamat</span>
                    </div>
                </div>
            </div>
            <button @click="openAddAddress = false" class="absolute right-6 top-6 text-gray-400 hover:text-gray-800 text-3xl">&times;</button>
        </div>

        <div class="px-10 py-8 border-t border-gray-100">
            <h4 class="text-xl font-bold text-gray-900 mb-6">Di mana lokasi tujuan pengirimanmu?</h4>
            
            <div class="relative mb-6">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" 
                       placeholder="Tulis nama jalan / gedung / perumahan" 
                       class="w-full pl-12 pr-4 py-4 bg-white border border-gray-200 rounded-2xl text-base focus:border-brand-500 outline-none transition-all">
            </div>

            <button class="text-gray-500 font-medium text-sm hover:text-brand-700 transition">
                Mau cara lain? <span class="text-brand-500 font-bold">Isi alamat secara manual</span>
            </button>
        </div>
    </div>
</div>