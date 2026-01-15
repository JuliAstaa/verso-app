{{-- Modal Manage --}}
<div x-show="showModal" class="fixed inset-0 z-[999] flex items-center justify-center p-4" x-cloak style="display: none;">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showModal = false"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b flex justify-between items-center bg-gray-50/50">
            <h3 class="font-bold text-gray-800 text-left w-full">Manage Payment</h3>
            <button @click="showModal = false" class="text-gray-400 hover:text-gray-800 transition text-2xl cursor-pointer">&times;</button>
        </div>
        <div class="p-6 text-left">
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest mb-3">Add New Method</p>
            
            {{-- BCA --}}
            <div @click="openForm('BCA')" class="flex items-center justify-between p-3 border rounded-xl hover:border-[#74553d] cursor-pointer transition mb-2">
                <span class="text-sm font-medium">BCA Virtual Account</span>
                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>

            {{-- DANA --}}
            <div @click="openForm('DANA')" class="flex items-center justify-between p-3 border rounded-xl hover:border-[#74553d] cursor-pointer transition mb-2">
                <span class="text-sm font-medium">DANA</span>
                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            </div>
        </div>
    </div>
</div>

{{-- Modal Form --}}
<div x-show="showForm" class="fixed inset-0 z-[1000] flex items-center justify-center p-4" x-cloak style="display: none;">
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="showForm = false"></div>
    <div class="relative bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 border text-left">
        <h3 class="font-bold text-lg text-gray-800 mb-4">Link <span x-text="selectedMethod"></span></h3>
        
        <div class="space-y-4">
            {{-- Form Input: Nama Akun --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1">Account Name</label>
                <input type="text" placeholder="e.g. Arya Ganteng" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-1 focus:ring-[#74553d] outline-none">
            </div>

            {{-- Form Input: Nomor Rekening / HP --}}
            <div>
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-1" 
                    x-text="selectedMethod === 'DANA' ? 'Phone Number' : 'Account Number'"></label>
                <input type="text" :placeholder="selectedMethod === 'DANA' ? '0812xxxx' : 'Enter account number'" 
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl text-sm focus:ring-1 focus:ring-[#74553d] outline-none">
            </div>
        </div>

        <div class="flex gap-2 pt-6">
            {{-- Tombol Back pakai x-button (Outline Style) --}}
            <x-button @click="showForm = false; showModal = true" 
                class="flex-1 !py-3 !text-sm !font-bold !text-[#74553d] !bg-white !border !border-[#74553d] hover:!bg-gray-50 !no-underline">
                Back
            </x-button>

            {{-- Tombol Save pakai x-button (Solid Style) --}}
            <x-button @click="showForm = false" 
                class="flex-1 !py-3 !text-sm !font-bold !no-underline">
                Save
            </x-button>
        </div>
    </div>
</div>