<x-layouts.app title="Detail Product - Verso">
    <x-navbar :noShadow="true" />

    <livewire:product.product-detail :slug="$slug" />

    <x-footer />
</x-layouts.app>