<div class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm">

    {{-- Container Modal --}}
    <div class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col border border-gray-100 shadow-2xl animate-fade-in-up">
        
        {{-- Header --}}
        <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
            <div>
                <h3 class="font-bold text-gray-800 text-lg">Edit Profile</h3>
                <p class="text-xs text-gray-400 mt-0.5">Update personal info & photo</p>
            </div>
            {{-- Tombol Close: Pake wire:click --}}
            <button wire:click="$set('openEditProfile', false)" class="text-gray-400 hover:text-gray-800 text-2xl p-2 transition">&times;</button>
        </div>

        {{-- Form Content --}}
        <div class="flex-1 overflow-y-auto p-8 custom-scrollbar">
            <form wire:submit="updateProfile" class="space-y-6">
    
    {{-- BAGIAN 1: UPLOAD FOTO (Tetap Sama kayak sebelumnya) --}}
    <div class="flex flex-col sm:flex-row items-center gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
        <div class="relative w-24 h-24 shrink-0">
            @if ($avatar) 
                <img src="{{ $avatar->temporaryUrl() }}" class="w-full h-full rounded-2xl object-cover border-2 border-white shadow-sm">
            @elseif ($existingAvatar)
                <img src="{{ Storage::url($existingAvatar) }}" class="w-full h-full rounded-2xl object-cover border-2 border-white shadow-sm">
            @else
                        <div class="w-full h-full bg-brand-600 text-white flex items-center justify-center font-bold text-2xl rounded-2xl border-2 border-white shadow-sm">
                            {{ strtoupper(substr($name ?? 'User', 0, 2)) }}
                        </div>
                    @endif
                    
                </div>
                <div class="flex-1 w-full text-center sm:text-left">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Profile Picture</label>
                    <input type="file" wire:model="avatar" id="avatarInput" class="hidden" accept="image/*">
                    <label for="avatarInput" class="inline-block px-4 py-2 bg-white border border-gray-200 text-gray-600 text-xs font-bold rounded-lg cursor-pointer hover:bg-gray-50 transition">
                        Choose File
                    </label>
                    @error('avatar') <span class="text-xs text-red-500 block mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- BAGIAN 2: INPUT FIELDS (GRID LAYOUT) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                {{-- Full Name --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700 ml-1">Full Name</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-0 outline-none transition-all placeholder-gray-300">
                    @error('name') <span class="text-xs text-red-500 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Username (Baru) --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700 ml-1">Username</label>
                    <input type="text" wire:model="username" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-0 outline-none transition-all placeholder-gray-300">
                    @error('username') <span class="text-xs text-red-500 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Birth Date --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700 ml-1">Birth Date</label>
                    <input type="date" wire:model="birth_date" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-0 outline-none text-gray-600">
                    @error('birth_date') <span class="text-xs text-red-500 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Gender --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700 ml-1">Gender</label>
                    <div class="relative">
                        <select wire:model="gender" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-0 outline-none appearance-none cursor-pointer text-gray-700">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </div>
                    </div>
                    @error('gender') <span class="text-xs text-red-500 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Phone Number --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700 ml-1">Phone Number</label>
                    <input type="tel" wire:model="phone" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-0 outline-none placeholder-gray-300">
                    @error('phone') <span class="text-xs text-red-500 block ml-1">{{ $message }}</span> @enderror
                </div>

                {{-- Email Address --}}
                <div class="space-y-1.5">
                    <label class="text-xs font-bold text-gray-700 ml-1">Email Address</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-2.5 bg-white border border-gray-200 rounded-xl text-sm focus:border-brand-500 focus:ring-0 outline-none placeholder-gray-300">
                    @error('email') <span class="text-xs text-red-500 block ml-1">{{ $message }}</span> @enderror
                </div>

            </div>

            {{-- BAGIAN 3: FOOTER BUTTONS --}}
            <div class="pt-6 border-t border-gray-100 flex flex-row gap-4 mt-4">
                <button type="button" wire:click="$set('openEditProfile', false)" class="flex-1 py-3 border border-gray-200 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition text-sm">
                    Back
                </button>
                <button type="submit" class="flex-1 py-3 bg-brand-500 text-white font-bold rounded-xl hover:bg-brand-700 transition text-sm flex justify-center items-center gap-2 shadow-lg shadow-brand-600/20">
                    <span wire:target="updateProfile">Save Changes</span>
                </button>
            </div>

        </form>
        </div>
    </div>
</div>