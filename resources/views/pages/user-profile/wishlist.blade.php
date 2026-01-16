{{-- resources/views/pages/user-profile/profile.blade.php --}}
<x-layouts.app>
    <x-navbar />

    <div class="max-w-7xl mx-auto py-10 px-4">
        {{-- Flexbox: Memastikan kiri dan kanan terpisah --}}
        <div class="flex flex-col md:flex-row gap-8 items-start">
            
            {{-- KOLOM SIDEBAR (25%) --}}
            <div class="w-full md:w-1/4">
                @include('pages.user-profile.sidebar')
            </div>

            {{-- KOLOM KONTEN WISHLIST (75%) --}}
            <div class="w-full md:w-3/4">
                @include('sections.profile.sidebar.wishlist')
            </div>

        </div>
    </div>
    <x-footer />
</x-layouts.app>