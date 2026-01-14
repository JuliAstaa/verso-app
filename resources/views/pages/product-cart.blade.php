<x-layouts.app title="Product Cart Verso">
    <x-navbar :dynamic="true"/>
    
    <div class="bg-gray-100 min-h-screen">
        <livewire:cart.cart-page />
    </div>

    <x-footer />
</x-layouts.app>