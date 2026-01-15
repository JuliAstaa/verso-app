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
                <div class="w-48 aspect-square bg-gray-100 rounded-xl overflow-hidden mb-4 border border-gray-100 shadow-sm">
                    <img src="https://ui-avatars.com/api/?name=Arya+Ganteng&background=74553d&color=fff" 
                         class="w-full h-full object-cover" alt="Profile">
                </div>
                
                <div class="w-48">
                    <x-button variant="solid" @click="openEditProfile = true" class="w-full !py-2.5 text-sm font-bold !no-underline !rounded-xl">
                        Edit Profile
                    </x-button>
                </div>
                
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
                            <span class="text-sm font-bold text-gray-800">Arya Ganteng</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Birth Date</span>
                            <span class="text-sm text-gray-400 italic">Not set</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Gender</span>
                            <span class="text-sm text-gray-400 italic">Not set</span>
                        </div>
                    </div>
                </div>

                <div class="text-left">
                    <h3 class="text-base font-bold text-gray-800 mb-6">Contact</h3>
                    <div class="space-y-6">
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Email</span>
                            <span class="text-sm font-bold text-gray-800 truncate">aryagantengbngt@gmail.com</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 w-1/3">Phone Number</span>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-bold text-gray-800">081234567</span>
                                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>