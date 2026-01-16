{{-- resources/views/pages/pembayaran.blade.php --}}
<x-layouts.app title="Transaction List - Verso">
    <x-navbar />

    <div class="bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="flex flex-col md:flex-row gap-6">
                
                {{-- Bagian Kiri: Sidebar --}}
                <aside class="w-full md:w-1/3 lg:w-1/4">
                    @include('pages.user-profile.sidebar')
                </aside>

                {{-- Bagian Kanan: Konten Utama --}}
                <main class="w-full md:w-2/3">
                    {{-- Kita panggil section yang baru dibuat tadi --}}
                    <livewire:front.customer.transaction-list>
                </main>

            </div>
        </div>
    </div>

    <x-footer />
</x-layouts.app>