@props(['dynamic' => false, 'noShadow' => false])

<nav
    x-data="{ isScrolled: false }"
    x-init="isScrolled = window.pageYOffset > 0"
    x-on:scroll.window="isScrolled = (window.pageYOffset > 0)"
    :class="{ 
        'shadow-none border-transparent': @js($noShadow),
        'shadow-sm border-b border-gray-100': !@js($noShadow) && (@js(!$dynamic) || isScrolled),
        'border-transparent shadow-none': !@js($noShadow) && @js($dynamic) && !isScrolled
    }"
    class="h-auto bg-white sticky top-0 z-[100] transition-shadow duration-100"
>

    <div class="bg-[#6B4F3B] py-1">
        <div class="mx-auto max-w-[90%] lg:max-w-[80%]">
            <div class="flex justify-end">
              <div class="flex space-x-4">
                <a href="#" class="px-3 py-2 text-[10px] md:text-sm font-medium text-white hover:text-[#C8B29A]">About Verso</a>
                <a href="#" class="px-3 py-2 text-[10px] md:text-sm font-medium text-white hover:text-[#C8B29A]">Contact Us</a>
                <a href="#" class="px-3 py-2 text-[10px] md:text-sm font-medium text-white hover:text-[#C8B29A]">Verso Care</a>
              </div>
            </div>
        </div>
    </div>

    <div class="min-h-24 flex items-center py-4">
        <div class="mx-auto max-w-[90%] lg:max-w-[80%] w-full">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                <div class="flex justify-between items-center gap-9 text-[#6B4F3B] font-bold w-full lg:w-auto">
                    <a href="{{ url('/') }}">
                        <h1 class="uppercase text-3xl md:text-4xl">Verso</h1>
                    </a>
                    
                    <livewire:navbar.category-dropdown />
                    
                </div>

                <div class="flex flex-1 justify-between items-center gap-4 md:gap-8 w-full">
                    <livewire:navbar.navbar-search />
                    
                    <livewire:navbar.cart-badge />
                </div>

                <div class="flex items-center gap-3 md:gap-5 w-full lg:w-auto justify-center md:justify-end">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 group focus:outline-none">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center text-white overflow-hidden border-2 border-transparent group-hover:border-brand-500 transition-all">
                                    <img class="w-full h-full object-cover" src="{{ Auth::user()->avatar }}" alt="">
                                </div>

                                <div class="flex flex-col items-start md:flex">
                                    <div>
                                        <span class="text-sm font-bold text-brand-500 truncate max-w-[120px]">
                                            {{ auth()->user()->name }}
                                        </span>
                                    </div>
                                </div>
                            </button>

                            <div x-show="open" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100"
                                x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-3 w-72 bg-white rounded-2xl shadow-xl border border-gray-100 z-[110] overflow-hidden"
                                style="display: none;">
                                
                                <div class=" p-2 bg-gray-50/50 border-b border-gray-100 flex items-center gap-3">
                                    <div  class="w-12 h-12 rounded-full overflow-hidden border border-gray-200">
                                        <img class="w-full h-full object-cover" src="{{ Auth::user()->avatar }}" alt="">
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-sm font-bold text-gray-800 truncate">{{ auth()->user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ auth()->user()->email }}</p>
                                    </div>
                                </div>

                                <div class="py-2">
                                    <a href="{{ route('user.profile') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        My Profile
                                    </a>
                                    <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 hover:bg-brand-50 hover:text-brand-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        Settings
                                    </a>
                                </div>

                                <div class="border-t border-gray-100 py-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-500 hover:bg-red-50 transition font-bold">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                            Sign Out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}">
                            <x-button variant="outline" class="flex-1 lg:flex-none text-sm">
                                Login
                            </x-button>
                        </a>

                        <a href="{{ route('register') }}">
                            <x-button variant="solid" class="flex-1 lg:flex-none text-sm">
                                Sign Up
                            </x-button>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <div class="pb-4 lg:pb-2">
         <div class="mx-auto max-w-[90%] lg:max-w-[80%]">
            <a href="" class="flex justify-end items-center gap-1 text-[#6B4F3B] text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 10c0-2.21-1.79-4-4-4s-4 1.79-4 4 1.79 4 4 4 4-1.79 4-4m-6 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2"></path>
                    <path d="M11.42 21.81c.17.12.38.19.58.19s.41-.06.58-.19c.3-.22 7.45-5.37 7.42-11.82 0-4.41-3.59-8-8-8s-8 3.59-8 8c-.03 6.44 7.12 11.6 7.42 11.82M12 4c3.31 0 6 2.69 6 6 .02 4.44-4.39 8.43-6 9.74-1.61-1.31-6.02-5.29-6-9.74 0-3.31 2.69-6 6-6"></path>
                </svg>
                <p>Sent to <span class="font-bold">Bali</span></p>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" >
                    <path d="m12 15.41 5.71-5.7-1.42-1.42-4.29 4.3-4.29-4.3-1.42 1.42z"></path>
                </svg>
            </a>
         </div>
     </div>
</nav>