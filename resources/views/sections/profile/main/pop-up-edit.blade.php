{{-- resources/views/sections/profile/modal-edit-profile.blade.php --}}
<div x-show="openEditProfile" 
     x-effect="openEditProfile ? document.body.classList.add('overflow-hidden') : document.body.classList.remove('overflow-hidden')"
     class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" 
     x-cloak>
    
    <div @click.away="openEditProfile = false" 
         class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col border border-gray-100">
        
        {{-- Header Modal --}}
        <div class="px-8 py-5 border-b border-gray-100 flex justify-between items-center bg-white">
            <div>
                <h3 class="font-bold text-gray-800 text-lg">Edit Profile</h3>
                <p class="text-xs text-gray-400 mt-0.5">Update your personal information and photo</p>
            </div>
            <button @click="openEditProfile = false" class="text-gray-400 hover:text-gray-800 text-2xl p-2">&times;</button>
        </div>

        {{-- Form Content (Scrollable Area) --}}
        <div class="flex-1 overflow-y-auto p-8">
            {{-- Menggunakan @submit.prevent agar tidak error "Method Not Supported" karena belum ada backend --}}
            <form id="editProfileForm" @submit.prevent="alert('Changes saved (UI Test only)')" class="space-y-8">
                @csrf
                
                {{-- Bagian Upload Foto --}}
                <div class="flex flex-col sm:flex-row items-center gap-6 p-6 bg-gray-50 rounded-2xl border border-gray-100">
                    <div class="relative group">
                        <img src="https://ui-avatars.com/api/?name=Arya+Ganteng&background=74553d&color=fff" 
                             class="w-24 h-24 rounded-2xl object-cover border-2 border-white">
                    </div>
                    <div class="flex-1 text-center sm:text-left">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-2">Profile Picture</label>
                        <input type="file" class="block w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-[#74553d] file:text-white hover:file:bg-[#5a4230] cursor-pointer">
                        <p class="mt-2 text-[10px] text-gray-400">JPG, PNG or JPEG. Max size 10MB.</p>
                    </div>
                </div>

                {{-- Personal Info Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Full Name --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-700 ml-1">Full Name</label>
                        <input type="text" value="Arya Ganteng" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#74553d] outline-none transition-all">
                    </div>
                    
                    {{-- Birth Date --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-700 ml-1">Birth Date</label>
                        <input type="date" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#74553d] outline-none transition-all">
                    </div>

                    {{-- Gender --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-700 ml-1">Gender</label>
                        <select class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#74553d] outline-none transition-all appearance-none">
                            <option value="">Select Gender</option>
                            <option value="male" selected>Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>

                    {{-- Phone Number --}}
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-gray-700 ml-1">Phone Number</label>
                        <input type="text" value="081234567" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#74553d] outline-none transition-all">
                    </div>
                </div>

                {{-- Email --}}
                <div class="space-y-2">
                    <label class="text-xs font-bold text-gray-700 ml-1">Email Address</label>
                    <input type="email" value="aryagantengbngt@gmail.com" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:border-[#74553d] outline-none transition-all">
                </div>
            </form>
        </div>

        {{-- Footer Buttons --}}
        <div class="px-8 py-6 border-t border-gray-100 bg-white flex flex-row gap-4">
            <x-button type="button" @click="openEditProfile = false" 
                      variant="outline" 
                      class="flex-1 py-3">
                Back
            </x-button>
            <x-button  variant="solid" type="submit" form="editProfileForm" 
                      class="flex-1 py-3">
                Save Changes
            </x-button>
        </div>
    </div>
</div>