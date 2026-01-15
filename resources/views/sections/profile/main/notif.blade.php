<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden font-poppins">
    
    {{-- TOP TABS NAVIGATION --}}
    <div class="flex border-b border-gray-100 px-6">
        <a href="/profile/bio" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Bio Data
        </a>
        <a href="/profile/address-list" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Address List
        </a>
        <a href="/profile/notification" class="px-6 py-4 text-sm font-bold text-brand-500 border-b-2 border-brand-500 -mb-[1px]">
            Notification
        </a>
        <a href="/profile/security" class="px-6 py-4 text-sm font-medium text-gray-500 hover:text-brand-500 transition">
            Security
        </a>
    </div>

    {{-- MAIN CONTENT AREA --}}
    <div class="p-8">
        <div class="max-w-3xl">
            <h3 class="text-base font-bold text-gray-800 mb-2">Notification Settings</h3>
            <p class="text-xs text-gray-400 mb-8">Manage how you receive updates about your orders.</p>
            
            <div class="divide-y divide-gray-100">
                @php
                    $notifications = [
                        'Waiting for Payment',
                        'Waiting for Confirmation',
                        'Order Processed',
                        'Order Shipped',
                        'Order Completed',
                        'Reminders'
                    ];
                @endphp

                @foreach($notifications as $item)
                <label class="flex items-center justify-between py-5 cursor-pointer group">
                    <span class="text-sm text-gray-600 group-hover:text-brand-700 transition font-medium">{{ $item }}</span>
                    
                    {{-- Menggunakan style inline untuk memastikan warna cokelat brand muncul --}}
                    <input type="checkbox" checked 
                           style="accent-color: #74553d;" 
                           class="w-5 h-5 rounded border-gray-300 cursor-pointer transition-all">
                </label>
                @endforeach
            </div>

            {{-- Save Button --}}
            <div class="mt-10 flex justify-end">
                <x-button variant="solid" class="!px-12 !py-3 !rounded-xl !text-sm">
                    Update Preferences
                </x-button>
            </div>
        </div>
    </div>
</div>