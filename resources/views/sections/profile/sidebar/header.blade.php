<div class="flex items-center space-x-4 border-b border-gray-300 pb-6 mb-6">
    <div class="relative group">
        <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 border-2 border-gray-100 shadow-sm transition-transform group-hover:scale-105">
              @if(Auth::user()->profile && Auth::user()->profile->avatar)
                
                {{-- A. Kalo Ada Foto --}}
                {{-- object-cover biar gambar ga gepeng kalau aslinya persegi panjang --}}
                <img src="{{ asset('storage/' . Auth::user()->profile->avatar) }}" 
                    alt="{{ Auth::user()->name }}" 
                    class="w-full h-full object-cover">
            
            @else
                
                {{-- B. Kalo Null (Fallback Inisial) --}}
                {{-- substr ambil 2 huruf pertama, strtoupper biar kapital semua --}}
                <span class="flex w-full h-full bg-brand-500 font-bold text-white items-center justify-center">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
            
            @endif
        </div>
    </div>
    <div>
        <h2 class="text-xl font-bold text-gray-800 leading-none">
            {{ auth()->user()->name ?? 'Guest' }}
        </h2>
        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider font-semibold">Verified Member</p>
    </div>
</div>