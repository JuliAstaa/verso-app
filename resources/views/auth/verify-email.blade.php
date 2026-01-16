<x-layouts.app title="Verifikasi Email - Verso">
    
    <div class="min-h-[80vh] flex flex-col justify-center items-center bg-gray-50 px-4 py-12 font-sans">
        
        {{-- Main Card --}}
        <div class="w-full pt-5 sm:max-w-[480px] bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100 rounded-3xl p-8sm:p-10 text-center relative overflow-hidden">
            
            {{-- Aksen Hiasan Background (Opsional, biar ga sepi) --}}
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-50 rounded-full opacity-50 pointer-events-none"></div>
            <div class="absolute -bottom-12 -left-12 w-40 h-40 bg-brand-50 rounded-full opacity-50 pointer-events-none"></div>

            <div class="relative z-10">
                {{-- 1. Hero Icon (Visual Pendukung) --}}
                <div class="mx-auto w-24 h-24 bg-brand-50/80 rounded-2xl flex items-center justify-center mb-6 ring-4 ring-brand-50 shadow-sm animate-fade-in-down">
                    <svg class="w-12 h-12 text-brand-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>

                {{-- 2. Judul & Teks Baru (Inti Pesan) --}}
                <h1 class="text-2xl font-serif font-bold text-gray-900 mb-4">
                    Verifikasi Email Diperlukan
                </h1>
                
                <div class="space-y-3 text-gray-600 text-sm leading-relaxed mb-8">
                    <p class="font-medium text-gray-700">
                        Halo, <span class="text-brand-600">{{ auth()->user()->name }}</span>!
                    </p>
                    {{-- 🔥 Teks Baru Sesuai Request 🔥 --}}
                    <p>
                        Demi menjaga privasi dan keamanan akun Anda, serta sebagai syarat wajib sebelum melakukan <strong class="text-gray-800">Checkout</strong>, mohon verifikasi alamat email Anda terlebih dahulu.
                    </p>
                    <p class="text-xs text-gray-500">
                        Kami telah mengirimkan link verifikasi ke: <br>
                        <span class="font-bold text-brand-600">{{ auth()->user()->email }}</span>
                    </p>
                </div>

                {{-- 3. Feedback Sukses (Kalau habis klik resend) --}}
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-6 p-4 bg-green-50 text-green-700 text-sm font-medium rounded-xl border border-green-100 flex items-center gap-3 text-left animate-fade-in">
                        <svg class="w-5 h-5 shrink-0 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                        <p>Link verifikasi baru berhasil dikirim! Silakan cek inbox atau folder spam email Anda.</p>
                    </div>
                @endif

                {{-- 4. Action Buttons (Tombol Aksi) --}}
                <div class="flex flex-col gap-3">
                    {{-- Tombol Utama: Resend --}}
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="w-full bg-brand-500 hover:bg-brand-700 text-white font-bold py-3.5 rounded-xl shadow-lg shadow-brand-600/20 transition-all transform hover:-translate-y-0.5 active:scale-95 flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                            Kirim Ulang Email Verifikasi
                        </button>
                    </form>

                    {{-- Tombol Sekunder: Logout --}}
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full bg-white border-2 border-gray-100 text-gray-600 hover:border-gray-300 hover:bg-red-500 hover:text-white hover:border-0 font-bold py-3.5 rounded-xl transition flex justify-center items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                            Keluar Akun
                        </button>
                    </form>
                </div>
            </div>

        </div>
        

        {{-- Footer Kecil --}}
        <p class="mt-8 text-xs text-center text-gray-400">
            Butuh bantuan? <a href="#" class="text-brand-600 hover:underline">Hubungi Support</a> <br>
            &copy; {{ date('Y') }} Verso. All rights reserved.
        </p>

    </div>
</x-layouts.app>