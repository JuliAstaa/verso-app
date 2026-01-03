<x-layouts.app title="Verso-App">
    <x-navbar />

    @include('sections.hero')

    @include('sections.categories')
    
    @include('sections.product-section')
    
    @include('sections.about')

    @include('sections.advantages')
    
    <x-footer />
</x-layouts.app>