<x-layouts.app title="Detail Product - Verso">
    <x-navbar :noShadow="true" />

    <div 
        x-data="{ 
            showSubNav: false,
            handleScroll() {
                this.showSubNav = window.scrollY > 10;
            }
        }" 
        x-init="window.addEventListener('scroll', () => handleScroll())"
        x-show="showSubNav"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="-translate-y-full"
        x-transition:enter-end="translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="translate-y-0"
        x-transition:leave-end="-translate-y-full"
        class="fixed top-[165px] left-0 w-full z-[90] bg-white border-1 border-gray-100 shadow-sm hidden lg:block"
        style="display: none;"
    >
        <div class="w-[80%] mx-auto h-16 grid grid-cols-12 items-center">
            <div class="col-span-3">
                <p class="text-[13px] font-bold text-gray-800 truncate pr-10 italic">
                    SISTER'S BLOUSE - Kemeja Atasan Wanita Katun Bordir Y9462 (ZE)
                </p>
            </div>
            
            <div x-data="{ activeTab: 'detail' }" class="col-span-6 flex justify-center gap-12 h-full">
                
                <a href="#detail-section" 
                @click="activeTab = 'detail'"
                :class="activeTab === 'detail' ? 'text-[#6B4F3B] border-[#6B4F3B] font-bold' : 'text-gray-500 border-transparent font-medium'"
                class="h-full flex items-center text-sm border-b-2 transition-colors duration-200">
                Product Detail
                </a>

                <a href="#reviews-section" 
                @click="activeTab = 'review'"
                :class="activeTab === 'review' ? 'text-[#6B4F3B] border-[#6B4F3B] font-bold' : 'text-gray-500 border-transparent font-medium'"
                class="h-full flex items-center text-sm border-b-2 transition-colors duration-200 hover:text-[#6B4F3B]">
                Reviews
                </a>

                <a href="#recommendation-section" 
                @click="activeTab = 'recommend'"
                :class="activeTab === 'recommend' ? 'text-[#6B4F3B] border-[#6B4F3B] font-bold' : 'text-gray-500 border-transparent font-medium'"
                class="h-full flex items-center text-sm border-b-2 transition-colors duration-200 hover:text-[#6B4F3B]">
                Rekomendation
                </a>
            </div>

            <div class="col-span-3"></div>
        </div>
    </div>

    <main class="w-[80%] mx-auto py-8">
        <nav class="text-sm text-brand-500 mb-4 flex gap-2 italic">
            <a href="{{ route('pages.home') }}" class="text-brand-500">Home</a>
            <span>&rsaquo;</span>
            <a href="" class="font-medium italic">Category Product</a>
            <span>&rsaquo;</span>
            <a href="" class="font-medium italic">Nama Product</a>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start relative">
            
            <div class="lg:col-span-8">
                <div class="grid grid-cols-1 md:grid-cols-[40%_60%] gap-4 items-start border-b border-gray-200 pb-10">
                    
                    <div class="lg:sticky lg:top-[240px] w-[95%]"> 
                        @include('sections.product-detail.product-img')
                    </div>

                    <div class="mb-6"> 
                        @include('sections.product-detail.product-info')
                    </div>
                </div>
                
                <div class="pt-10">
                    <h2 class="text-xl font-medium mb-4">Buyer Reviews</h2>
                    @include('sections.product-detail.product-reviews')
                </div>
            </div>

            <aside class="lg:col-span-4 lg:sticky lg:top-[240px] w-[95%] justify-self-end">
                @include('sections.product-detail.purchase-card')
            </aside>

        </div>

        <div class="mt-60">
            <h1 class="w-fit text-xl border-b-2 border-brand-500 font-bold mb-6">Product Rekomendations</h1>
            <livewire:product.product-list :showLoadMore="false" :limit="14" :columns="6" />
        </div>
    </main>

    <x-footer />
</x-layouts.app>