<div class="relative inline-block font-poppins">
    {{-- TOMBOL UTAMA --}}
    <button wire:click="$set('openAddressModal', true)" class="flex items-center gap-1.5 cursor-pointer group py-1 px-2 hover:bg-gray-50 rounded-lg transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400 group-hover:text-brand-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
        
        <div class="flex flex-col items-start leading-none">
            <span class="text-[10px] text-gray-400 uppercase font-bold tracking-tight">Sent to</span>
            <div class="flex items-center gap-1">
                <span class="text-xs font-bold text-gray-800">
                    {{ $selectedAddress ? $selectedAddress->city->name : 'Select Location' }}
                </span>
                <svg class="h-3 w-3 text-gray-400 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
    </button>

    {{-- MODAL --}}
    @if($openAddressModal)
        <div class="fixed inset-0 z-[999] flex items-center justify-center p-4">
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" wire:click="$set('openAddressModal', false)"></div>

            <div class="relative bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
                {{-- Header --}}
                <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-white sticky top-0">
                    <h3 class="font-bold text-gray-800">Choose Shipping Address</h3>
                    <button wire:click="$set('openAddressModal', false)" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- List Alamat --}}
                <div class="p-5 space-y-3 max-h-[50vh] overflow-y-auto custom-scrollbar">
                    @forelse($addresses as $address)
                        <div wire:click="selectAddress({{ $address->id }})" 
                             class="p-4 rounded-xl border-2 cursor-pointer transition flex flex-col gap-1 relative
                             {{ $selectedAddress && $selectedAddress->id == $address->id ? 'border-brand-500 bg-brand-50/20' : 'border-gray-100 hover:border-brand-200' }}">
                            
                            @if($address->is_default)
                                <span class="absolute top-3 right-3 bg-brand-500 text-white text-[9px] font-bold px-1.5 py-0.5 rounded uppercase">Default</span>
                            @endif

                            <p class="text-xs font-bold text-gray-900">{{ $address->label }} <span class="text-gray-400 font-medium">| {{ $address->receiver_name }}</span></p>
                            <p class="text-[11px] text-gray-500 line-clamp-2 leading-relaxed">{{ $address->complete_address }}</p>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-sm text-gray-400">No address found.</p>
                        </div>
                    @endforelse
                </div>

                {{-- Footer --}}
                <div class="p-4 bg-gray-50 border-t border-gray-100 flex flex-col gap-2">
                    <a href="/profile/address-list" class="w-full py-2.5 bg-white border border-gray-200 text-gray-700 text-xs font-bold rounded-xl text-center hover:bg-gray-100 transition">
                        Manage Addresses
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>