<nav class="h-auto bg-white shadow-sm">
    <!-- Top Navbar -->
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

    <!-- Bottom Navbar -->
    <div class="min-h-24 flex items-center py-4">
        <div class="mx-auto max-w-[90%] lg:max-w-[80%] w-full">
            <div class="flex flex-col lg:flex-row justify-between items-center gap-6">
                <div class="flex justify-between items-center gap-9 text-[#6B4F3B] font-bold w-full lg:w-auto">
                    <a href="{{ url('/') }}">
                        <h1 class="uppercase text-3xl md:text-4xl">Verso</h1>
                    </a>
                    <a href="" class="text-lg md:text-xl">Category</a>
                </div>

                <div class="flex flex-1 justify-between items-center gap-4 md:gap-8 w-full">
                    <div class="w-full">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 md:w-6 md:h-6 text-[#6B4F3B]" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" class="block w-full p-2 pl-10 text-sm text-[#6B4F3B] border border-[#6B4F3B] rounded-md bg-white focus:ring-1 focus:ring-[#6B4F3B] outline-none" placeholder="Search in verso" required="">
                            </div>
                        </form>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="#" class="text-[#6B4F3B]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" md:width="40" md:height="40" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M17.5 18a1.5 1.5 0 1 0 0 3 1.5 1.5 0 1 0 0-3M8.82 15.77c.31.75 1.04 1.23 1.85 1.23h6.18c.79 0 1.51-.47 1.83-1.2l3.24-7.4c.14-.31.11-.67-.08-.95S21.34 7 21 7H7.33L5.92 3.62C5.76 3.25 5.4 3 5 3H2v2h2.33zM19.47 9l-2.62 6h-6.18l-2.5-6z"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <div class="flex items-center gap-3 md:gap-5 w-full lg:w-auto justify-center md:justify-end">
                    <x-button variant="outline" class="flex-1 lg:flex-none text-sm">Login</x-button>
                    <x-button variant="solid" class="flex-1 lg:flex-none text-sm">Sign Up</x-button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Address -->
    <div class="pb-4 lg:pb-2">
         <div class="mx-auto max-w-[90%] lg:max-w-[80%]">
            <a href="" class="flex justify-end items-center gap-1 text-[#6B4F3B] text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M16 10c0-2.21-1.79-4-4-4s-4 1.79-4 4 1.79 4 4 4 4-1.79 4-4m-6 0c0-1.1.9-2 2-2s2 .9 2 2-.9 2-2 2-2-.9-2-2"></path>
                    <path d="M11.42 21.81c.17.12.38.19.58.19s.41-.06.58-.19c.3-.22 7.45-5.37 7.42-11.82 0-4.41-3.59-8-8-8s-8 3.59-8 8c-.03 6.44 7.12 11.6 7.42 11.82M12 4c3.31 0 6 2.69 6 6 .02 4.44-4.39 8.43-6 9.74-1.61-1.31-6.02-5.29-6-9.74 0-3.31 2.69-6 6-6"></path>
                </svg>
                <p>Sent to <span class="font-bold">Bali</span></p>
                <svg  xmlns="http://www.w3.org/2000/svg" width="24" height="24"  
                    fill="currentColor" viewBox="0 0 24 24" >
                    <path d="m12 15.41 5.71-5.7-1.42-1.42-4.29 4.3-4.29-4.3-1.42 1.42z"></path>
                </svg>
            </a>
         </div>
     </div>
</nav>