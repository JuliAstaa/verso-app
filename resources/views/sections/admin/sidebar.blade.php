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
            <p class="px-3 text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Tools</p>

            <a href="{{ route('admin.products') }}" 
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

            <a href="" class="flex items-center gap-3 px-3 py-2.5 mt-2 text-sm font-medium text-gray-500 hover:text-brand-700 hover:bg-brand-100 rounded-xl transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chart-no-axes-combined-icon lucide-chart-no-axes-combined"><path d="M12 16v5"/><path d="M16 14v7"/><path d="M20 10v11"/><path d="m22 3-8.646 8.646a.5.5 0 0 1-.708 0L9.354 8.354a.5.5 0 0 0-.707 0L2 15"/><path d="M4 18v3"/><path d="M8 14v7"/></svg>
                Analytics
            </a>
        </div>
    </nav>
</aside>