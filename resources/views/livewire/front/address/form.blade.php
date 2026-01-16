<div class="fixed inset-0 z-100 bg-black/40 backdrop-blur-sm flex items-center justify-center p-4 transition-opacity"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0">

    {{-- MODAL BOX --}}
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform transition-all scale-100">
        
        {{-- 1. HEADER (PENTING: Biar ga mepet atas) --}}
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100 bg-gray-50">
            <h3 class="font-bold text-lg text-gray-800">Add New Address</h3>
            <button type="button"  @click="$dispatch('close-modal')" class="text-gray-400 hover:text-red-500 transition rounded-lg p-1 hover:bg-red-50">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>

        {{-- 2. FORM BODY --}}
        <div class="p-6 overflow-y-auto max-h-[80vh]">
            <form wire:submit="save" class="space-y-5"> {{-- space-y-5 biar jarak antar baris lega --}}
                
                {{-- Row 1: Label & Receiver --}}
                <div class="grid grid-cols-2 gap-5">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Label</label>
                        <input wire:model="label" type="text" placeholder="e.g. Home, Office" 
                            class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] focus:border-[#5B4636] placeholder-gray-300 p-2.5">
                        @error('label') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Name</label>
                        <input wire:model="receiver_name" type="text" placeholder="Jhon Doe"
                            class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] focus:border-[#5B4636] placeholder-gray-300 p-2.5">
                        @error('receiver_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Phone --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Phone Number</label>
                    <input wire:model="phone" type="text" placeholder="0812..."
                        class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] focus:border-[#5B4636] placeholder-gray-300 p-2.5">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Area Selector (Box Abu-abu) --}}
                <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Province</label>
                            <select wire:model.live="province_code" class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] py-2">
                                <option value="">Select Province</option>
                                @foreach($provinces as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">City</label>
                            <select wire:model.live="city_code" class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] py-2" @if(empty($cities)) disabled @endif>
                                <option value="">Select City</option>
                                @foreach($cities as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">District</label>
                            <select wire:model.live="district_code" class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] py-2" @if(empty($districts)) disabled @endif>
                                <option value="">Select District</option>
                                @foreach($districts as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Village</label>
                            <select wire:model.live="village_code" class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] py-2" @if(empty($villages)) disabled @endif>
                                <option value="">Select Village</option>
                                @foreach($villages as $code => $name)
                                    <option value="{{ $code }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-1 col-span-2">
                            <label class="text-[10px] font-bold text-gray-400 uppercase">Postal Code</label>
                            <input wire:model.live="postal_code" type="number" class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] py-2">
                        </div>
                    </div>
                    @error('province_code') <p class="text-red-500 text-xs italic">Location is required.</p> @enderror
                </div>

                {{-- Full Address --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Full Address Details</label>
                    <textarea wire:model="detail" rows="3" placeholder="Street name, house number, etc."
                        class="w-full text-sm border-gray-200 rounded-lg focus:ring-[#5B4636] focus:border-[#5B4636] placeholder-gray-300 p-2.5"></textarea>
                    @error('detail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="pt-4 flex gap-3 border-t border-gray-100">
                    <button type="button" @click="$dispatch('close-modal')" class="w-1/3 py-2.5 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
                        Cancel
                    </button>
                    <button type="submit" class="w-2/3 py-2.5 rounded-xl text-sm font-bold text-white bg-[#5B4636] hover:bg-[#4a3a2d] transition shadow-lg shadow-[#5B4636]/20 flex items-center justify-center gap-2">
                        <span>Save Address</span>
                        
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>