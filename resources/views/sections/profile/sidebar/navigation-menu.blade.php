{{-- resources/views/sections/profile/navigation-menu.blade.php --}}
<nav class="space-y-8 pt-8 border-t border-gray-200 text-left">

    {{-- Section: My Profile --}}
    <div x-data="{ open: true }">
        {{-- Judul Section Digedein --}}
        <button @click="open = !open" class="flex items-center justify-between w-full text-base font-extrabold text-gray-800 cursor-pointer group text-[20px]">
            <span class="group-hover:text-black transition-colors">Profile</span>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        <ul x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            class="mt-4 ml-4 space-y-4 text-sm text-[15px]">
            <li></li>
                <a href="/profile" 
                   class="block py-1 transition-all {{ request()->is('profile') ? 'text-brown-600 font-bold' : 'text-gray-500 hover:text-black' }}">
                    My Profile
                </a>
                <a href="/profile/wishlist" class="text-gray-500 hover:text-black cursor-pointer py-1 transition-all">
                    Wishlist
                </a>
            </li>
        </ul>
    </div>

    {{-- Section: Purchases --}}
    <div x-data="{ open: true }">
        {{-- Judul Section Digedein --}}
        <button @click="open = !open" class="text-[20px] flex items-center justify-between w-full text-base font-extrabold text-gray-900 cursor-pointer group">
            <span class="group-hover:text-black transition-colors">Purchases</span>
            <svg :class="open ? 'rotate-180' : ''" class="w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
            </svg>
        </button>

        {{-- List Menu dengan Jarak Lebih Luas --}}
        <ul x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            class="mt-4 ml-4 space-y-4 text-sm text-[15px]">
            <li>
                <a href="/profile/payment" 
                   class="block py-1 transition-all {{ request()->is('profile/payment') ? 'text-brand-500 font-bold' : 'text-gray-500 hover:text-black' }}">
                    Waiting for Payment
                </a>
            </li>
            <li>
                <a href="/profile/transaction" 
                   class="block py-1 transition-all {{ request()->is('profile/transaction') ? 'text-brand-500 font-bold' : 'text-gray-500 hover:text-black' }}">
                    Transaction List
                </a>
            </li>
        </ul>
    </div>

</nav>