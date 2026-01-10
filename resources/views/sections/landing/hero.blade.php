<section class="w-full bg-white py-6">
    <div class="mx-auto max-w-[90%] lg:max-w-[80%]">
        
        <div x-data="{ 
                activeSlide: 1, 
                slides: 3,
                loop() {
                    setInterval(() => {
                        this.activeSlide = this.activeSlide === this.slides ? 1 : this.activeSlide + 1
                    }, 5000)
                } 
            }" 
            x-init="loop()"
            class="relative overflow-hidden rounded-2xl shadow-md bg-gray-100"
        >
            
            <div x-show="activeSlide === 1" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
                <img src="{{ asset('images/hero/slider1.svg') }}" alt="Banner 1" class="h-full w-full object-cover">
            </div>

            <div x-show="activeSlide === 2" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
                <img src="{{ asset('images/hero/slider2.svg') }}" alt="Banner 2" class="h-full w-full object-cover">
            </div>

            <div x-show="activeSlide === 3" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform scale-105"
                 x-transition:enter-end="opacity-100 transform scale-100"
                 class="aspect-[16/7] md:aspect-[21/9] lg:aspect-[3/1]">
                <img src="{{ asset('images/hero/slider3.svg') }}" alt="Banner 3" class="h-full w-full object-cover">
            </div>

            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <template x-for="i in slides">
                    <button 
                        @click="activeSlide = i" 
                        :class="activeSlide === i ? 'bg-white w-8' : 'bg-white/50 w-2'"
                        class="h-2 rounded-full transition-all duration-300 shadow-sm">
                    </button>
                </template>
            </div>

            <button @click="activeSlide = activeSlide === 1 ? slides : activeSlide - 1" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white hidden md:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button @click="activeSlide = activeSlide === slides ? 1 : activeSlide + 1" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 hover:bg-white/40 p-2 rounded-full text-white hidden md:block">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

        </div>
    </div>
</section>