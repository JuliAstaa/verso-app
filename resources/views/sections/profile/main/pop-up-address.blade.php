{{-- Modal Pop Up Add Address --}}
<div x-show="openAddAddress" 
     x-effect="openAddAddress ? document.body.classList.add('overflow-hidden') : document.body.classList.remove('overflow-hidden')"
     class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
     x-cloak>
    
    {{-- max-h-[90vh] agar modal tidak melebihi tinggi layar HP, overflow-y-auto supaya bisa di-scroll isinya --}}
    <div @click.away="openAddAddress = false" 
         class="bg-white rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto shadow-2xl border border-gray-100 font-poppins scrollbar-hide">
        
        {{-- Header Modal - Sticky agar tetap terlihat saat scroll --}}
        <div class="px-6 py-4 flex justify-between items-center border-b border-gray-50 sticky top-0 bg-white z-10">
            <h3 class="text-lg font-bold text-gray-800 tracking-tight">Add New Address</h3>
            <button @click="openAddAddress = false" class="text-gray-400 hover:text-gray-600 cursor-pointer">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        {{-- Form Content --}}
        <form action="#" method="POST" class="p-6 space-y-4">
            @csrf
            
            {{-- Grid tetap 2 kolom, tapi di layar sangat kecil (xs) bisa kita buat tumpuk jika perlu --}}
            <div class="grid grid-cols-2 gap-3">
                <div class="space-y-1">
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest">Label</label>
                    <input type="text" name="label" placeholder="Home"
                           class="w-full px-3 py-2 rounded-xl border border-gray-100 bg-gray-50 text-xs focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none">
                </div>
                <div class="space-y-1">
                    <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest">Name</label>
                    <input type="text" name="name" placeholder="Name"
                           class="w-full px-3 py-2 rounded-xl border border-gray-100 bg-gray-50 text-xs focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest">Phone Number</label>
                <input type="number" name="phone_number" placeholder="081234567"
                       class="w-full px-3 py-2 rounded-xl border border-gray-100 bg-gray-50 text-xs focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none">
            </div>

            {{-- Gray Box Wilayah --}}
            <div class="bg-gray-50/50 p-4 rounded-xl border border-gray-50 space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest">Province</label>
                        <select name="province" class="w-full px-2 py-1.5 bg-white border border-gray-200 rounded-lg text-[11px] outline-none focus:border-brand-500 cursor-pointer">
                            <option value="" selected disabled>Select Province</option>
                            <option value="BALI">BALI</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest">City</label>
                        <select name="city" class="w-full px-2 py-1.5 bg-white border border-gray-200 rounded-lg text-[11px] outline-none focus:border-brand-500 cursor-pointer">
                            <option value="" selected disabled>Select City</option>
                            <option value="KABUPATEN KARANGASEM">KABUPATEN KARANGASEM</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3">
                    <div class="space-y-1">
                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest">District</label>
                        <select name="district" class="w-full px-2 py-1.5 bg-white border border-gray-200 rounded-lg text-[11px] outline-none focus:border-brand-500 cursor-pointer">
                            <option value="" selected disabled>Select District</option>
                            <option value="SELAT">SELAT</option>
                        </select>
                    </div>
                    <div class="space-y-1">
                        <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest">Village</label>
                        <select name="village" class="w-full px-2 py-1.5 bg-white border border-gray-200 rounded-lg text-[11px] outline-none focus:border-brand-500 cursor-pointer">
                            <option value="" selected disabled>Select Village</option>
                            <option value="SEBUDI">SEBUDI</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-1 w-full sm:w-1/2">
                    <label class="block text-[8px] font-bold text-gray-400 uppercase tracking-widest">Postal Code</label>
                    <input type="number" name="postal_code" placeholder="Input code"
                           class="w-full px-2 py-1.5 bg-white border border-gray-200 rounded-lg text-[11px] outline-none focus:border-brand-500">
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-[9px] font-bold text-gray-400 uppercase tracking-widest">Full Address Details</label>
                <textarea name="full_address" rows="2" placeholder="Full Address Details"
                          class="w-full px-3 py-2 rounded-xl border border-gray-100 bg-gray-50 text-xs focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none resize-none"></textarea>
            </div>

            {{-- Action Buttons - Sticky bottom agar tombol simpan tidak hilang saat scroll --}}
            <div class="grid grid-cols-2 gap-3 pt-2 sticky bottom-0 bg-white">
                <x-button variant="outline" type="button" @click="openAddAddress = false" class="w-full !py-2.5 !rounded-xl !bg-[#F3F4F6] !border-none !text-gray-500 !text-xs">
                    Cancel
                </x-button>
                <x-button variant="solid" type="submit" class="w-full !py-2.5 !rounded-xl !text-xs">
                    Save Address
                </x-button>
            </div>
        </form>
    </div>
</div>