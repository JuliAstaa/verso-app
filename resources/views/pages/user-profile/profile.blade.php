<x-layouts.app title="User Profile - Verso">
    <x-navbar />

    {{-- Kita letakkan x-data di sini agar mencakup Modal dan Main Content --}}
    <div class="bg-gray-50 min-h-screen py-10">
        


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                {{-- Sidebar Kiri --}}
                <aside class="w-full md:w-1/3 lg:w-1/4">
                    @include('pages.user-profile.sidebar')
                </aside>

                {{-- Konten Utama Kanan --}}
                <main class="flex-1">
                    {{-- File ini yang berisi tampilan data dan tombol "Edit Profile" --}}
                    <livewire:front.user-profile.bio-data>
                </main>

            </div>
        </div>
    </div>
        
    <x-footer />
</x-layouts.app>