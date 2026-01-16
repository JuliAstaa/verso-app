<table class="w-full text-sm text-left">
    <thead class="bg-gray-50 text-gray-500 font-bold border-b border-gray-100">
        <tr>
            <th class="px-4 py-3">User Identity</th>
            <th class="px-4 py-3">Email Status</th>
            <th class="px-4 py-3">Customer Status</th>
            <th class="px-4 py-3">Joined</th>
            <th class="px-4 py-3 text-center">Action</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
        @forelse($customers as $customer)
            <tr class="hover:bg-gray-50 transition group">
                {{-- Identity --}}
                <td class="px-4 py-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-xs font-bold text-gray-500 overflow-hidden">
                            <img class="w-full h-full object-cover" src="{{ $customer->avatar }}" alt="">
                        </div>
                        <div>
                            <div class="font-bold text-gray-800">{{ $customer->name }}</div>
                            <div class="text-xs text-gray-400">{{ $customer->email }}</div>
                        </div>
                    </div>
                </td>

                {{-- Status --}}
                <td class="px-4 py-3">
                    <div class="flex flex-col gap-1 items-start">
                        {{-- Verified Badge --}}
                        @if($customer->hasVerifiedEmail())
                            <span class="text-[10px] bg-green-50 text-green-600 px-2 py-0.5 rounded border border-green-100">VERIFIED</span>
                        @else
                            <span class="text-[10px] bg-yellow-50 text-yellow-600 px-2 py-0.5 rounded border border-yellow-100">UNVERIFIED</span>
                        @endif

                        
                    </div>
                </td>
                <td class="px-4 py-3">
                    <div class="flex flex-col gap-1 items-start">

                        {{-- Banned Badge --}}
                        @if(!$customer->trashed())
                            <span class="text-[10px] bg-green-50 text-green-600 px-2 py-0.5 rounded border border-green-100">ACTIVE</span>
                        @else
                            <span class="text-[10px] bg-red-50 text-red-600 px-2 py-0.5 rounded border border-red-100 font-bold">BANNED</span>
                        @endif

                        
                    </div>
                </td>

                {{-- Joined --}}
                <td class="px-4 py-3 text-gray-500">
                    {{ $customer->created_at->format('d M Y') }}
                </td>

                {{-- Action --}}
                <td class="px-4 py-3 text-center">
                    @if($customer->trashed())
                        <button wire:click="banUser({{ $customer->id }})" 
                                wire:confirm="Restore user ini?"
                                class="text-green-600 hover:text-green-800 text-xs font-bold underline decoration-dotted">
                            Restore
                        </button>
                    @else
                        <button wire:click="banUser({{ $customer->id }})" 
                                wire:confirm="Ban user ini?"
                                class="text-red-400 hover:text-red-600 text-xs font-medium hover:underline">
                            Ban User
                        </button>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="px-6 py-10 text-center text-gray-400 border-2 border-dashed border-gray-100 rounded-xl bg-gray-50 mt-4">
                    <p class="font-bold">Belum ada customer</p>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>