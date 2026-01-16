{{-- resources/views/sections/profile/bio-data-content.blade.php --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden font-poppins">
    
    {{-- TOP TABS NAVIGATION --}}
    <div class="flex border-b border-gray-100 px-6">
        {{-- Tab Aktif: Bio Data diberi warna brand dan border bawah --}}
        <a href="/profile/bio" class="px-6 py-4 text-sm font-bold text-brand-500 border-b-2 border-brand-500 -mb-[1px]">
            Bio Data
        </a>
        <a href="/profile/address-list" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
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
    <div class="p-8">
        <div class="flex flex-col md:flex-row gap-12">
            
            {{-- LEFT COLUMN: PROFILE IMAGE & BUTTON --}}
            <div class="w-full md:w-1/3 flex flex-col items-center">
                <div class="w-48 aspect-square bg-brand-500 text-white font-extrabold rounded-xl overflow-hidden mb-4 border border-gray-100 shadow-sm flex items-center justify-center">
                    <img class="w-full h-full object-cover" src="{{ Auth::user()->avatar }}" alt="">
                </div>
                
                <div class="w-48">
                    <x-button type="button" wire:click="$set('openEditProfile', true)" class="w-full !py-2.5 text-sm font-bold !no-underline !rounded-xl cursor-pointer">
                            <span wire:target="$set('openEditProfile', true)">Edit Profile</span>
                         
                        </x-button>
                </div>
                <!-- MODAL EDIT PROFILE -->


                
                <div class="mt-4 text-center">
                    <p class="text-[10px] text-gray-400 leading-relaxed uppercase tracking-wider font-bold">Requirements:</p>
                    <p class="text-[10px] text-gray-400 leading-relaxed">
                        Max file size: 10MB <br>
                        Formats: .JPG, .JPEG, .PNG
                    </p>
                </div>
            </div>

            {{-- RIGHT COLUMN: DISPLAY FIELDS --}}
            <div class="w-full md:w-2/3 space-y-10">
                <div class="text-left">
                    <h3 class="text-base font-bold text-gray-800 mb-6">Bio Data</h3>
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Name</span>
                            <span class="text-sm font-bold text-gray-800">{{ $name }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Birth Date</span>
                            <span class="text-sm text-gray-400 italic">{{ $birth_date ? $birth_date : 'Not Set' }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Gender</span>
                            <span class="text-sm text-gray-400 italic">{{ $gender ? $gender : 'Not Set' }}</span>
                        </div>
                    </div>
                </div>

                <div class="text-left">
                    <h3 class="text-base font-bold text-gray-800 mb-6">Contact</h3>
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Email</span>
                                <div class="flex gap-5 justify-between items-center">

                                    <span class="text-sm font-bold text-gray-800 truncate">{{ $email ? $email : 'Not Set' }} </span>
                                    @if(Auth::user()->email_verified_at)
                                        <span class="text-green-600 text-sm font-bold flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                            Verified
                                        </span>
                                    @else
                                        <form method="POST" action="{{ route('verification.send') }}">
                                            @csrf
                                            <div>
                                                <button type="button" 
                                                        wire:click="resendVerification"
                                                        wire:loading.attr="disabled"
                                                        class="text-xs font-bold text-red-500 hover:text-red-700 hover:underline cursor-pointer transition disabled:opacity-50 disabled:cursor-wait">
                                                    
                                                    {{-- Text Normal --}}
                                                    <span wire:loading.remove wire:target="resendVerification">
                                                        UNVERIFIED (RESEND?)
                                                    </span>

                                                    {{-- Text Pas Loading --}}
                                                    <span wire:loading wire:target="resendVerification">
                                                        SENDING...
                                                    </span>
                                                </button>
                                                
                                                {{-- Munculin Notif Sukses Kecil di Bawahnya --}}
                                                @if (session('success'))
                                                    <div class="text-[10px] text-green-600 font-bold mt-1">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </form>
                                    @endif
                                </div>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Phone Number</span>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-bold text-gray-800">{{ $phone ? $phone : 'Not Set' }}</span>
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @if($openEditProfile)
        @include('sections.profile.main.pop-up-edit')
    @endif
</div>