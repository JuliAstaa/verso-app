<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden font-poppins">
    {{-- TOP TABS NAVIGATION --}}
    <div class="flex border-b border-gray-100 px-6">
        <a href="/profile/bio" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Bio Data
        </a>
        {{-- Aktifkan tab Address List dengan warna brand --}}
        <a href="/profile/address-list" class="px-6 py-4 text-sm font-bold text-brand-500 border-b-2 border-brand-500 -mb-[1px]">
            Address List
        </a>
        <a href="/profile/notification" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Notification
        </a>
        <a href="/profile/security" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Security
        </a>
    </div>

    {{-- MAIN CONTENT AREA --}}
   <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
      
    <div class="flex justify-between items-center mb-6">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Address</h3>
        </div>

        {{-- 👇 1. UPDATE TOMBOL CREATE --}}
        {{-- Jangan pake $set, tapi panggil function 'create' biar ID ke-reset --}}
        <button wire:click="create" 
            class="px-4 py-2 border border-dashed text-xs font-bold rounded-lg hover:bg-gray-50 transition cursor-pointer flex items-center gap-2">
            + Create Address
        </button>
        
        {{-- Modal Logic --}}
        @if($showModalAddress)
            <livewire:front.address.form 
            :id="$addressIdToEdit" 
            :key="'address-form-' . ($addressIdToEdit ?? 'new')" 
        />
        @endif
    </div>

    {{-- List Alamat --}}
<div class="space-y-4">
    @forelse($addresses as $address)

        <div class="group relative border {{ $address->is_default ? 'border-[#5B4636] bg-[#5B4636]/5' : 'border-gray-200 hover:border-[#5B4636]/30' }} rounded-xl p-5 transition-all duration-200">
            
            @if($address->is_default)
   
                <span class="absolute top-4 right-4 bg-[#5B4636] text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm z-10 cursor-default">
                    DEFAULT
                </span>
            @else

                <button wire:click="setDefault({{ $address->id }})" 
                        wire:loading.attr="disabled"
                        class="absolute top-4 right-4 bg-white border border-[#5B4636] text-[#5B4636] text-[10px] font-bold px-3 py-1 rounded-full 
                               opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0 
                               hover:bg-[#5B4636] hover:text-white shadow-sm z-10">
                    Set as Default
                </button>
            @endif




            <div class="flex items-start gap-4">
                {{-- Icon Rumah/Lokasi --}}
                <div class="p-2.5 bg-white rounded-full text-gray-500 shadow-sm border border-gray-100">
                    <svg class="w-5 h-5 {{ $address->is_default ? 'text-[#5B4636]' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                </div>

                <div class="flex-1">
                    <div class="flex items-center gap-2">
                        <p class="font-bold text-gray-800 text-sm">{{ $address->label }}</p>
                        <span class="text-gray-300">|</span>
                        <p class="text-gray-800 text-sm font-medium">{{ $address->receiver_name }}</p>
                    </div>

                    <p class="text-gray-500 text-xs mt-1.5 leading-relaxed pr-12">
                        <span class="font-bold text-gray-600 block mb-0.5">{{ $address->phone }}</span>
                        {{ $address->detail }}<br>
                        {{ $address->district->name ?? '' }}, {{ $address->city->name ?? '' }}, {{ $address->province->name ?? '' }} {{ $address->postal_code }}
                    </p>
                    
                    {{-- Action Buttons (Edit/Delete) --}}
                    <div class="flex gap-4 mt-4 border-t border-gray-100 pt-3">
                        <button wire:click="deleteAddress({{ $address->id }})"
                                wire:confirm="Yakin ingin menghapus alamat ini?"
                                class="text-xs font-bold text-gray-400 hover:text-red-600 hover:underline transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            Delete
                        </button>

                        <button wire:click="edit({{ $address->id }})"
                                class="text-xs font-bold text-gray-400 hover:text-[#5B4636] hover:underline transition-colors flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" /></svg>
                            Edit Address
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-10 border-2 border-dashed border-gray-100 rounded-xl bg-gray-50/50">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <h3 class="text-gray-900 font-bold text-sm">Alamat Kosong</h3>
            <p class="text-xs text-gray-500 mt-1 max-w-xs mx-auto">Kamu belum menambahkan alamat pengiriman apapun.</p>
        </div>
    @endforelse
</div>
</div>
