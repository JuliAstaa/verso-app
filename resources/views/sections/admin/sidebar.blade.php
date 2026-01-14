<aside class="w-64 h-full bg-white flex flex-col">
    <div class="text-center py-4">
        <h1 class="font-bold text-3xl uppercase text-brand-700">Verso</h1>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        <div class="pb-4">
            <a href="{{ route('admin.dashboard') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.dashboard'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.dashboard'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-gauge-icon lucide-gauge"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.customers') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.customers'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.customers'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-icon lucide-users"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><path d="M16 3.128a4 4 0 0 1 0 7.744"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><circle cx="9" cy="7" r="4"/></svg>
                Customers
            </a>
        </div>

        <hr class="mx-3.5">

        <div class="pt-4 border-t border-gray-50">
            <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">TRANSACTIONS</p>

            <a href="{{ route('admin.products.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.products'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.products'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 640 640" class="size-6"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M142 66.2C150.5 62.3 160.5 63.7 167.6 69.8L208 104.4L248.4 69.8C257.4 62.1 270.7 62.1 279.6 69.8L320 104.4L360.4 69.8C369.4 62.1 382.6 62.1 391.6 69.8L432 104.4L472.4 69.8C479.5 63.7 489.5 62.3 498 66.2C506.5 70.1 512 78.6 512 88L512 552C512 561.4 506.5 569.9 498 573.8C489.5 577.7 479.5 576.3 472.4 570.2L432 535.6L391.6 570.2C382.6 577.9 369.4 577.9 360.4 570.2L320 535.6L279.6 570.2C270.6 577.9 257.3 577.9 248.4 570.2L208 535.6L167.6 570.2C160.5 576.3 150.5 577.7 142 573.8C133.5 569.9 128 561.4 128 552L128 88C128 78.6 133.5 70.1 142 66.2zM232 200C218.7 200 208 210.7 208 224C208 237.3 218.7 248 232 248L408 248C421.3 248 432 237.3 432 224C432 210.7 421.3 200 408 200L232 200zM208 416C208 429.3 218.7 440 232 440L408 440C421.3 440 432 429.3 432 416C432 402.7 421.3 392 408 392L232 392C218.7 392 208 402.7 208 416zM232 296C218.7 296 208 306.7 208 320C208 333.3 218.7 344 232 344L408 344C421.3 344 432 333.3 432 320C432 306.7 421.3 296 408 296L232 296z"/></svg>
                Transactions
            </a>
        <div class="pt-4 border-t border-gray-50">
            <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Tools</p>

            <a href="{{ route('admin.products.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.products.index'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.products.index'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                Products
            </a>

            <a href="{{ route('admin.categories.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.categories.index'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.categories.index'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 0 0 3 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 0 0 5.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 0 0 9.568 3Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6Z" />
                </svg>

                Categories
            </a>

            <a href="{{ route('admin.colors.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.colors.index'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.colors.index'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                    </svg>
                    Colors
                </a>

            <a href="{{ route('admin.sizes.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.sizes.index'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.sizes.index'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 640 640" class="size-6"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M241.1 580.2C222.4 598.9 192 598.9 173.2 580.2L60.1 467.1C41.4 448.4 41.4 418 60.1 399.2L77.1 382.2L150.6 455.7C160 465.1 175.2 465.1 184.5 455.7C193.8 446.3 193.9 431.1 184.5 421.8L111 348.3L144.9 314.4L195.8 365.3C205.2 374.7 220.4 374.7 229.7 365.3C239 355.9 239.1 340.7 229.7 331.4L178.8 280.5L212.7 246.6L286.2 320.1C295.6 329.5 310.8 329.5 320.1 320.1C329.4 310.7 329.5 295.5 320.1 286.2L246.6 212.7L280.5 178.8L331.4 229.7C340.8 239.1 356 239.1 365.3 229.7C374.6 220.3 374.7 205.1 365.3 195.8L314.4 144.9L348.3 111L421.8 184.5C431.2 193.9 446.4 193.9 455.7 184.5C465 175.1 465.1 159.9 455.7 150.6L382.2 77.1L399.2 60.1C417.9 41.4 448.3 41.4 467.1 60.1L580.5 172.9C599.2 191.6 599.2 222 580.5 240.8L241.1 580.2z"/></svg> Sizes
                </a>

            <a href="" class="flex items-center gap-3 px-3 py-2.5 mt-2 text-sm font-medium text-gray-500 hover:text-brand-700 hover:bg-brand-100 rounded-xl transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
                Analytics
            </a>
        </div>
    </nav>
</aside>