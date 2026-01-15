<header class="h-16 bg-white shadow-sm items-center flex justify-end pe-6">
  {{-- Container Dropdown (Pake Alpine JS) --}}
<div class="relative" x-data="{ open: false }">
    
    {{-- 1. TRIGGER TOMBOL (Profile Kamu yg Sekarang) --}}
    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none transition hover:opacity-80">
        
        {{-- Avatar Circle --}}
        <div class="w-10 h-10 rounded-full bg-[#5B4636] flex items-center justify-center text-white font-bold text-sm border-2 border-transparent hover:border-gray-200 transition overflow-hidden">
    
            {{-- LOGIC: Cek Relasi Profile & Kolom Avatar --}}
            @if(Auth::user()->profile && Auth::user()->profile->avatar)
                
                {{-- A. Kalo Ada Foto --}}
                {{-- object-cover biar gambar ga gepeng kalau aslinya persegi panjang --}}
                <img src="{{ asset('storage/' . Auth::user()->profile->avatar) }}" 
                    alt="{{ Auth::user()->name }}" 
                    class="w-full h-full object-cover">
            
            @else
                
                {{-- B. Kalo Null (Fallback Inisial) --}}
                {{-- substr ambil 2 huruf pertama, strtoupper biar kapital semua --}}
                <span>{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
            
            @endif

        </div>
        {{-- Teks Nama & Role --}}
        <div class="hidden md:block text-left">
            <p class="text-sm font-bold text-gray-800 leading-none">{{ Auth::user()->name }}</p>
            <p class="text-[10px] text-gray-500 uppercase tracking-wide mt-1">{{ Auth::user()->role }}</p>
        </div>

        {{-- Icon Panah Kecil (Opsional, biar tau bisa diklik) --}}
        <svg class="w-4 h-4 text-gray-400" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </button>

    {{-- 2. MENU DROPDOWN (Muncul pas diklik) --}}
    <div x-show="open" 
         @click.outside="open = false"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="absolute right-0 mt-3 w-64 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50 origin-top-right"
         style="display: none;"> {{-- style display none biar gak kedip pas load --}}
        
        {{-- Header Menu (Info User) --}}
        <div class="px-4 py-3 border-b border-gray-50 flex items-center gap-3 mb-2">
            <div class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 font-bold">
                 {{ substr(Auth::user()->name, 0, 2) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
        </div>

        {{-- Menu Links --}}
        <a href="{{ route('admin.profile') }}" class=" px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            My Profile
        </a>
        
        <a href="#" class=" px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            Settings
        </a>

        <div class="border-t border-gray-100 my-2"></div>

        {{-- LOGOUT BUTTON --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 font-medium flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Sign Out
            </button>
        </form>

    </div>
</div>
</header>