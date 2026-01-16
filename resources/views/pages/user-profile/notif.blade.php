<x-layouts.app title="Notification - Verso">
    <x-navbar />

        {{-- State Alpine.js mencakup modal tambah alamat --}}
    <div x-data="{ openAddAddress: false }" class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                {{-- Sidebar Kiri --}}
                <aside class="w-full md:w-1/3 lg:w-1/4">
                    @include('pages.user-profile.sidebar')
                </aside>

                {{-- Konten Utama Address List --}}
                <main class="flex-1">
                    @include('sections.profile.main.notif')
                </main>

            </div>
        </div>
    </div>

    <x-footer />
</x-layouts.app>