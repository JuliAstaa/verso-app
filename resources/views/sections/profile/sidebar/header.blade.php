<div class="flex items-center space-x-4 border-b border-gray-300 pb-6 mb-6">
    <div class="relative group">
        <div class="w-16 h-16 rounded-full overflow-hidden bg-gray-200 border-2 border-gray-100 shadow-sm transition-transform group-hover:scale-105">
            @if(auth()->user() && auth()->user()->profile_photo_path)
                <img src="{{ asset('storage/' . auth()->user()->profile_photo_path) }}" alt="Profile" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center bg-[#74553d] text-white text-xl font-bold uppercase">
                    {{ substr(auth()->user()->name ?? 'Guest', 0, 1) }}
                </div>
            @endif
        </div>
    </div>
    <div>
        <h2 class="text-xl font-bold text-gray-800 leading-none">
            {{ auth()->user()->name ?? 'Guest' }}
        </h2>
        <p class="text-[10px] text-gray-400 mt-1 uppercase tracking-wider font-semibold">Verified Member</p>
    </div>
</div>