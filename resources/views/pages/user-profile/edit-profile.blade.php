<x-layouts.app title="Edit Profile - Verso">
    <x-navbar />

    {{-- resources/views/pages/user-profile/edit-profile.blade.php --}}
    @extends('layouts.app') {{-- Sesuaikan dengan layout kamu --}}

    @section('content')
    <div x-data="{ openEditProfile: false }" class="max-w-6xl mx-auto py-10 px-4">
        
        {{-- Memanggil Pop-up Modal --}}
        @include('sections.profile.modal-edit-profile')

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Memanggil Navigasi Tab --}}
            @include('sections.profile.profile-tabs')

            {{-- Memanggil Konten Utama Bio Data --}}
            @include('sections.profile.bio-data-content')
        </div>
    </div>
    @endsection

    <x-footer />
</x-layouts.app>