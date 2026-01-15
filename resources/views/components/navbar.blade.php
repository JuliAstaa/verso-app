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
                    <x-button variant="outline" class="flex-1 lg:flex-none text-sm">Login</x-button>
                    <x-button variant="solid" class="flex-1 lg:flex-none text-sm">Sign Up</x-button>
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