<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-3xl mx-auto">
        
        {{-- Header Ala PG --}}
        <div class="flex justify-between items-center mb-6">
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 bg-brand-600 rounded-lg flex items-center justify-center text-white font-bold">V</div>
                <h2 class="text-xl font-bold text-gray-800">Verso Secure Payment</h2>
            </div>
            <div class="text-sm text-gray-500 bg-white px-3 py-1 rounded-full shadow-sm">
                Order ID: <span class="font-mono font-bold text-brand-600">{{ $order->invoice_number }}</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            {{-- KIRI: Summary Order --}}
            <div class="md:col-span-1 space-y-4">
                {{-- Total Amount --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <p class="text-xs text-gray-500 uppercase tracking-wide mb-1">Total Amount</p>
                    <h3 class="text-2xl font-bold text-brand-600">Rp {{ number_format($order->total_price, 0, ',', '.') }}</h3>
                    <div class="mt-4 pt-4 border-t border-dashed border-gray-200">
                        <div class="flex justify-between text-xs mb-2">
                            <span class="text-gray-500">Order Date</span>
                            <span class="font-medium">{{ $order->created_at->format('d M Y') }}</span>
                        </div>
                         <div class="flex justify-between text-xs">
                            <span class="text-gray-500">Items</span>
                            <span class="font-medium">{{ $order->orderItems->count() }} Pcs</span>
                        </div>
                    </div>
                </div>

                {{-- Fake Timer --}}
                <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 text-center">
                    <p class="text-xs text-blue-600 mb-1">Selesaikan pembayaran dalam</p>
                    <p class="text-xl font-mono font-bold text-blue-700">23:59:59</p>
                </div>
            </div>

            {{-- KANAN: Pilihan Metode Pembayaran --}}
            <div class="md:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="border-b border-gray-100 bg-gray-50/50 px-6 py-4">
                    <h3 class="font-bold text-gray-700">Pilih Metode Pembayaran</h3>
                </div>

                {{-- Tabs --}}
                <div class="flex border-b border-gray-100">
                    <button wire:click="selectMethod('bca')" class="flex-1 py-3 text-sm font-medium border-b-2 {{ $paymentMethod === 'bca' ? 'border-brand-500 text-brand-600 bg-brand-50/50' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        Transfer Bank
                    </button>
                    <button wire:click="selectMethod('qris')" class="flex-1 py-3 text-sm font-medium border-b-2 {{ $paymentMethod === 'qris' ? 'border-brand-500 text-brand-600 bg-brand-50/50' : 'border-transparent text-gray-500 hover:text-gray-700' }}">
                        QRIS
                    </button>
                </div>

                <div class="p-6 min-h-[300px] flex flex-col justify-between">
                    
                    {{-- KONTEN: BANK TRANSFER --}}
                    @if($paymentMethod === 'bca')
                        <div class="space-y-6 animate-fade-in">
                            <div class="flex items-center gap-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                                <div class="w-12 h-8 bg-blue-800 rounded flex items-center justify-center text-white text-[10px] font-bold tracking-widest italic">
                                    BCA
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500">Bank Central Asia</p>
                                    <p class="text-sm font-bold text-gray-800">Virtual Account</p>
                                </div>
                            </div>

                            <div>
                                <label class="text-xs text-gray-500 block mb-1">Nomor Virtual Account</label>
                                <div class="flex gap-2">
                                    <input type="text" value="880123{{ $order->invoice_number }}" readonly class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-lg font-mono font-bold rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                                    <button onclick="alert('Copied!')" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg text-sm font-bold transition">Copy</button>
                                </div>
                                <p class="text-[10px] text-gray-400 mt-2">*Hanya simulasi, jangan transfer beneran woi.</p>
                            </div>
                        </div>
                    @endif

                    {{-- KONTEN: QRIS --}}
                    @if($paymentMethod === 'qris')
                        <div class="flex flex-col items-center justify-center space-y-4 animate-fade-in py-6">
                            <div class="w-48 h-48 bg-gray-900 rounded-xl flex items-center justify-center relative overflow-hidden group">
                                <div class="absolute inset-0 opacity-20 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-gray-100 via-gray-900 to-black"></div>
                                <div class="text-white text-center z-10">
                                    <svg class="w-16 h-16 mx-auto mb-2 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1h2a1 1 0 001-1zM11 7v3a1 1 0 001 1h2a1 1 0 001-1V7a1 1 0 00-1-1h-2a1 1 0 00-1 1zm-5 9h2a1 1 0 001-1v-2a1 1 0 00-1-1H6a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                                    <p class="text-xs font-mono">SCAN ME (DUMMY)</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500">Scan QRIS using GoPay, OVO, Dana</p>
                        </div>
                    @endif

                    {{-- ACTION BUTTON --}}
                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <button wire:click="simulatePayment" wire:loading.attr="disabled" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl shadow-lg shadow-green-500/30 transition transform hover:-translate-y-1 active:scale-95 flex justify-center items-center gap-2">
                            <span wire:loading.remove>✅ I Have Paid (Simulate Success)</span>
                            <span wire:loading>Processing Payment...</span>
                        </button>
                        <p class="text-center text-[10px] text-gray-400 mt-3">
                            Klik tombol di atas untuk simulasi pembayaran sukses otomatis.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>