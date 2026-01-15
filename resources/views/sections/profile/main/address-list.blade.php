<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    {{-- TOP TABS NAVIGATION --}}
    <div class="flex border-b border-gray-100 px-6">
        <a href="/profile/bio" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Bio Data
        </a>
        <a href="/profile/address-list" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Address List
        </a>
        <a href="/profile/bio" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Notification
        </a>
        <a href="/profile/bio" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Security
        </a>
    </div>

    {{-- MAIN CONTENT AREA --}}
    <div class="p-8">
        {{-- Header: Search & Add Button --}}
        <div class="flex flex-col md:flex-row gap-4 justify-between items-center mb-12">
            {{-- Search Bar --}}
            <div class="relative w-full md:w-2/3">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </span>
                <input type="text" 
                       placeholder="Tulis Nama Alamat / Kota / Kecamatan tujuan pengiriman" 
                       class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 outline-none transition-all">
            </div>

            {{-- Tombol Tambah Alamat --}}
            <x-button variant="solid" @click="openAddAddress = true" class="w-full md:w-auto rounded-xl">
                + Tambah Alamat Baru
            </x-button>
        </div>

        {{-- Empty State (Tampilan saat alamat tidak ada) --}}
        <div class="flex flex-col items-center justify-center py-20 text-center">
            <div class="w-40 h-40 mb-6 opacity-80">
                {{-- Gunakan path image ops_alamat_tidak_tersedia kamu di sini --}}
                <img src="{{ asset('images/empty-address.png') }}" alt="" class="w-full h-full object-contain">
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Ops!, alamat tidak tersedia</h2>
            <p class="text-gray-500 text-sm">Kamu bisa cari alamat dari kolom pencarian.</p>
        </div>
    </div>
</div>

{{-- INCLUDE MODAL TAMBAH ALAMAT --}}
@include('sections.profile.main.pop-up-address')