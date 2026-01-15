<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">My Profile</h1>
        <p class="text-sm text-gray-500">Manage your account settings and preferences.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- === KOLOM KIRI: CARD PROFILE === --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-center relative overflow-hidden">
                {{-- Background Hiasan di atas --}}
                <div class="absolute top-0 left-0 w-full h-24 bg-[#5B4636]/10"></div>
                
                <div class="relative z-10 mt-8">
                    {{-- Avatar Wrapper --}}
                    <div class="relative mx-auto w-32 h-32 group">
                        <div class="w-32 h-32 rounded-full border-4 border-white shadow-lg overflow-hidden bg-gray-200">
                            @if ($newAvatar)
                                {{-- Preview Upload Baru --}}
                                <img src="{{ $newAvatar->temporaryUrl() }}" class="w-full h-full object-cover">
                            @elseif ($avatar)
                                {{-- Avatar Lama --}}
                                <img src="{{ asset('storage/' . $avatar) }}" class="w-full h-full object-cover">
                            @else
                                {{-- Fallback Inisial --}}
                                <div class="w-full h-full flex items-center justify-center bg-[#5B4636] text-white text-3xl font-bold">
                                    {{ substr($name, 0, 2) }}
                                </div>
                            @endif
                        </div>

                        {{-- Tombol Upload Overlay --}}
                        <label class="absolute bottom-0 right-0 bg-white border border-gray-200 p-2 rounded-full shadow-md cursor-pointer hover:bg-gray-50 transition">
                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <input type="file" wire:model="newAvatar" class="hidden" accept="image/*">
                        </label>
                    </div>

                    {{-- Nama & Role --}}
                    <h2 class="mt-4 text-xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                    
                    <div class="mt-3">
                        <span class="px-3 py-1 bg-[#5B4636] text-white text-[10px] font-bold uppercase tracking-widest rounded-full">
                            {{ Auth::user()->role }}
                        </span>
                    </div>
                </div>

                {{-- Status Info Bawah (Opsional) --}}
                <div class="mt-8 border-t border-gray-100 pt-4 grid grid-cols-2 gap-4">
                    <div>
                        <span class="block text-xl font-bold text-gray-800">Active</span>
                        <span class="text-xs text-gray-400 uppercase">Status</span>
                    </div>
                    <div>
                        <span class="block text-xl font-bold text-gray-800">{{ Auth::user()->created_at->format('M Y') }}</span>
                        <span class="text-xs text-gray-400 uppercase">Joined</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2 space-y-8">
    
    {{-- === 1. GENERAL INFORMATION CARD === --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">General Information</h3>
            <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-bold uppercase tracking-wider rounded-full">Personal Details</span>
        </div>
        
        <form wire:submit="updateProfile" class="space-y-6">
            
            {{-- ROW 1: Name & Username --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Full Name</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                           <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </span>
                        <input wire:model="name" type="text" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636]">
                    </div>
                    @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Username</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path></svg>
                        </span>
                        <input wire:model="username" type="text" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636]" placeholder="username_keren">
                    </div>
                </div>
            </div>

            {{-- ROW 2: Email (Dengan Badge Verified) & Phone --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider flex justify-between">
                        Email Address
                        
                        {{-- 🔥 BADGE VERIFIED 🔥 --}}
                        @if(Auth::user()->email_verified_at)
                            <span class="text-green-600 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                Verified
                            </span>
                        @else
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" 
                                        class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline cursor-pointer transition">
                                    UNVERIFIED (RESEND?)
                                </button>
                            </form>
                        @endif
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </span>
                        <input wire:model="email" type="email" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636]">
                    </div>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Phone Number</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </span>
                        <input wire:model="phone" type="number" class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636]" placeholder="0812...">
                    </div>
                </div>
            </div>

            {{-- ROW 3: Gender & Birth Date --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Gender</label>
                    <select wire:model="gender" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636]">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Birth Date</label>
                    <input wire:model="birth_date" type="date" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636]">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-50">
                <button type="submit" class="bg-[#5B4636] text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-[#4a3a2d] transition shadow-lg shadow-[#5B4636]/20 flex items-center gap-2 cursor-pointer">
                    <span wire:target="updateProfile">Save Changes</span>
            </div>
        </form>
    </div>

    {{-- === 2. SECURITY CARD  === --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-lg font-bold text-gray-800">Security & Password</h3>
            <span class="px-3 py-1 bg-red-50 text-red-600 text-[10px] font-bold uppercase tracking-wider rounded-full">Sensitive</span>
        </div>
        
        <form wire:submit="updatePassword" class="space-y-6">
            {{-- Current Password --}}
            <div class="space-y-1">
                <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Current Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </span>
                    <input wire:model="current_password" type="password" 
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636] block hover:bg-white transition-all"
                        placeholder="••••••••">
                </div>
                @error('current_password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- New Password --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">New Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                        </span>
                        <input wire:model="password" type="password" 
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636] block hover:bg-white transition-all"
                            placeholder="New password (min. 6 chars)">
                    </div>
                    @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                </div>

                {{-- Confirm Password --}}
                <div class="space-y-1">
                    <label class="text-xs font-bold text-gray-500 uppercase tracking-wider">Confirm New Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <input wire:model="password_confirmation" type="password" 
                            class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-[#5B4636] focus:border-[#5B4636] block hover:bg-white transition-all"
                            placeholder="Re-type new password">
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-50">
                <button type="submit" class="bg-gray-800 text-white px-6 py-2.5 rounded-lg text-sm font-bold hover:bg-gray-900 transition flex items-center gap-2 cursor-pointer">
                    <span wire:target="updatePassword">Update Password</span>
                </button>
            </div>
        </form>
    </div>

    {{-- === 3. ADDRESS BOOK CARD (BARU) === --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
      
        <div class="flex justify-between items-center mb-6">
            <div>
                <h3 class="text-lg font-bold text-gray-800">Address</h3>
            </div>
            <button wire:click="$set('showModalAddress', true)" 
                class="px-4 py-2 border border-dashed {{ $address ? 'border-gray-300 text-gray-600' : 'border-[#5B4636] text-[#5B4636]' }} text-xs font-bold rounded-lg hover:bg-gray-50 transition cursor-pointer flex items-center gap-2">
            @if($address)
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                Edit Address
            @else
                + Create Address
            @endif
        </button>
            
            @if($showModalAddress)
                <livewire:admin.address.form />
            @endif
        </div>
    
        {{-- List Alamat --}}
        <div class="space-y-4">
            @forelse($user->addresses as $address)
                <div class="border {{ $address->is_default ? 'border-[#5B4636] bg-[#5B4636]/5' : 'border-gray-200' }} rounded-xl p-4 relative">
                    
                    @if($address->is_default)
                        <span class="absolute top-4 right-4 bg-[#5B4636] text-white text-[10px] font-bold px-2 py-0.5 rounded">DEFAULT</span>
                    @endif

                    <div class="flex items-start gap-4">
                        <div class="p-2 bg-white rounded-full text-gray-500 shadow-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-gray-800 text-sm">{{ $address->label }} ({{ $address->receiver_name }})</p>
                            <p class="text-gray-500 text-xs mt-1 leading-relaxed">
                                {{ $address->phone }}<br>
                                {{ $address->detail }}<br>
                                {{ $address->district->name }}, {{ $address->city->name }}, {{ $address->province->name }} {{ $address->postal_code }}
                            </p>
                            <div class="flex gap-3 mt-3">
                                <button wire:click="confirmDeleteAddress({{ $address->id }})"
                                        class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 border border-dashed border-gray-200 rounded-xl">
                    <p class="text-sm text-gray-400">Belum ada alamat tersimpan.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
        </div>
    </div>
</div>