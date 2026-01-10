<header class="h-16 bg-white shadow-sm flex justify-end pe-6">
    <a href="" class="flex items-center gap-3 cursor-pointer group">
        <div class="w-10 h-10">
            <img src="https://ui-avatars.com/api/?name=Estiaq+Noor&background=6B4F3B&color=fff" alt="Avatar" class="rounded-full">
        </div>

        <div class="hidden sm:block">
            <p class="text-sm font-semibold text-gray-800 group-hover:text-brand-500 transition-colors line-clamp-1">{{ Auth::user()->name }}</p>
            <p class="text-[11px] text-gray-400 uppercase tracking-wider font-medium">{{ Auth::user()->role }}</p>
        </div>
    </a>
</header>