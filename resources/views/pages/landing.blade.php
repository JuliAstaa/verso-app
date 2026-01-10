<x-layouts.app title="Verso-App">
    <x-navbar />

    @include('sections.landing.hero')

    @include('sections.landing.categories')
    
    @include('sections.landing.product-section')
    
    @include('sections.landing.about')

    @include('sections.landing.advantages')
    
    <x-footer />
</x-layouts.app>