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
          
            <a href="" class="flex items-center gap-3 px-3 py-2.5 mt-2 text-sm font-medium text-gray-500 hover:text-brand-700 hover:bg-brand-100 rounded-xl transition-all duration-200">
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                Transactions
            </a>
        <div class="pt-4 border-t border-gray-50">
            <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Tools</p>

            <a href="{{ route('admin.products.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.products'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.products'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                </svg>
                Products
            </a>

            <a href="{{ route('admin.colors.index') }}" 
            @class([
                    'flex items-center gap-3 px-3 py-2.5 text-sm transition-all duration-200 rounded-xl',
                    'font-semibold text-white bg-brand-500' => request()->routeIs('admin.products'),
                    'font-medium text-gray-500 hover:text-brand-500 hover:bg-brand-100' => !request()->routeIs('admin.products'),
                ])>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 640 640"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.--><path d="M576 320C576 320.9 576 321.8 576 322.7C575.6 359.2 542.4 384 505.9 384L408 384C381.5 384 360 405.5 360 432C360 435.4 360.4 438.7 361 441.9C363.1 452.1 367.5 461.9 371.8 471.8C377.9 485.6 383.9 499.3 383.9 513.8C383.9 545.6 362.3 574.5 330.5 575.8C327 575.9 323.5 576 319.9 576C178.5 576 63.9 461.4 63.9 320C63.9 178.6 178.6 64 320 64C461.4 64 576 178.6 576 320zM192 352C192 334.3 177.7 320 160 320C142.3 320 128 334.3 128 352C128 369.7 142.3 384 160 384C177.7 384 192 369.7 192 352zM192 256C209.7 256 224 241.7 224 224C224 206.3 209.7 192 192 192C174.3 192 160 206.3 160 224C160 241.7 174.3 256 192 256zM352 160C352 142.3 337.7 128 320 128C302.3 128 288 142.3 288 160C288 177.7 302.3 192 320 192C337.7 192 352 177.7 352 160zM448 256C465.7 256 480 241.7 480 224C480 206.3 465.7 192 448 192C430.3 192 416 206.3 416 224C416 241.7 430.3 256 448 256z"/></svg> Colors
                </a>

            <a href="" class="flex items-center gap-3 px-3 py-2.5 mt-2 text-sm font-medium text-gray-500 hover:text-brand-700 hover:bg-brand-100 rounded-xl transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
                Analytics
            </a>
        </div>
    </nav>
</aside>