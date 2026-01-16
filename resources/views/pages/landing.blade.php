<x-layouts.app title="Verso-App">
    <x-navbar :dynamic="true" />

    @include('sections.landing.hero')

    <livewire:landing.categories />
    
    @include('sections.landing.product-section')
    
    @include('sections.landing.about')

    @include('sections.landing.advantages')
    
    <x-footer />
</x-layouts.app>