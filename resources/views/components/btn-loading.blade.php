@props([
    'action',                 // Nama fungsi Livewire (misal: "save", "addToCart(1)")
    'loadingText' => 'Processing...', // Teks pas loading
    'confirm' => null,        // (Opsional) Kalau butuh confirm JS alert
])

<div x-data="{ loading: false }" class="w-full inline-block">
    <button 
        type="button"
        x-on:click="
            @if($confirm) if(!confirm('{{ $confirm }}')) return; @endif
            loading = true; 
            $wire.{{ $action }}
                .then(() => loading = false)
                .catch(() => loading = false)
        "
        x-bind:disabled="loading"
        {{ $attributes->merge(['class' => 'disabled:opacity-50 disabled:cursor-not-allowed transition-all flex items-center justify-center gap-2']) }}
    >
        {{-- Slot buat Icon/Teks Normal --}}
        <span x-show="!loading" class="flex items-center gap-2">
            {{ $slot }}
        </span>

        {{-- Loading State --}}
        <span x-show="loading" style="display: none;" class="flex items-center gap-2">
            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            {{ $loadingText }}
        </span>
    </button>
</div>