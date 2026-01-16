<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden font-poppins">
    
    {{-- TOP TABS NAVIGATION --}}
    <div class="flex border-b border-gray-100 px-6">
        <a href="/profile/bio" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Bio Data
        </a>
        <a href="/profile/address-list" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Address List
        </a>
        <a href="/profile/notification" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Notification
        </a>
        {{-- Tab Aktif: Security --}}
        <a href="/profile/security" class="px-6 py-4 text-sm font-bold text-brand-500 border-b-2 border-brand-500 -mb-[1px]">
            Security
        </a>
    </div>

    {{-- MAIN CONTENT AREA --}}
    <div class="p-8">
        <div class="flex justify-between items-center mb-8">
            <h3 class="text-base font-bold text-gray-800">Change Password</h3>
        </div>

        <form action="#" method="POST" class="space-y-6 max-w-4xl">
            @csrf
            
            {{-- Current Password --}}
            <div class="space-y-2">
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Current Password</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </span>
                    <input type="password" name="current_password" placeholder="••••••••"
                           class="w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- New Password --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">New Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                            </svg>
                        </span>
                        <input type="password" name="new_password" placeholder="New password (min. 6 chars)"
                               class="w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
                    </div>
                </div>

                {{-- Confirm New Password --}}
                <div class="space-y-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Confirm New Password</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </span>
                        <input type="password" name="new_password_confirmation" placeholder="Re-type new password"
                               class="w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-100 rounded-xl text-sm focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all">
                    </div>
                </div>
            </div>

            {{-- Button Update --}}
            <div class="flex justify-end pt-4">
                <x-button variant="solid" type="submit" class="!px-10 !py-3 !rounded-xl !text-sm shadow-lg shadow-brand-500/20">
                    Update Password
                </x-button>
            </div>
        </form>
    </div>
</div>