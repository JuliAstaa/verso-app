<div x-data="{ openEditProfile: @entangle('openEditProfile') }">
    {{-- Tampilan Utama Bio --}}
    @include('sections.profile.main.bio')

    {{-- Modal Popup Edit --}}
    @include('sections.profile.modal-edit-profile')
</div>