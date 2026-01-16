{{-- Container utama --}}
<div x-data="{ showBackendError: {{ ($errors->any() || session('error')) ? 'true' : 'false' }} }" 
     class="fixed inset-0 bg-white flex items-center justify-center z-[9999] overflow-y-auto md:overflow-hidden font-poppins p-4">
    
    {{-- ========================================== --}}
    {{-- 🔥 POP-UP MODAL ERROR --}}
    {{-- ========================================== --}}
    <div x-show="showBackendError" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-90"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
         style="display: none;">
        
        <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-sm text-center relative overflow-hidden border border-red-100">
            <div class="absolute top-0 left-0 w-full h-2 bg-red-500"></div>
            <div class="mx-auto w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mb-4">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Registration Failed</h3>
            <p class="text-sm text-gray-500 mb-6 px-2">
                @if ($errors->has('email'))
                    The email address is already in use. Please use another one or sign in.
                @elseif ($errors->any())
                    Please check the form for errors.
                @elseif (session('error'))
                    {{ session('error') }}
                @endif
            </p>
            <button @click="showBackendError = false" 
                    class="w-full py-2.5 bg-gray-900 hover:bg-gray-800 text-white rounded-xl text-sm font-bold transition-all">
                Fix it
            </button>
        </div>
    </div>
    {{-- ========================================== --}}

    {{-- Card Utama --}}
    <div class="bg-white w-full h-auto md:h-[90vh] max-w-[1200px] max-h-[750px] flex flex-col md:flex-row shadow-none md:shadow-none">
        
        {{-- Sisi Kiri: Ilustrasi --}}
        <div class="hidden md:flex md:w-1/2 bg-white flex-col py-8">
            <div class="w-full flex justify-center">
                <h1 class="text-4xl lg:text-6xl font-serif text-brand-500 tracking-[0.2em] leading-none">vérso</h1>
            </div>

            <div class="flex-grow flex flex-col items-center justify-center">
                <img src="{{ asset('images/login/signUp.svg') }}" 
                        alt="Verso Illustration" 
                        class="w-full max-w-[400px] lg:max-w-[500px] mx-auto">
                
                <div class="text-center px-4">
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Join the Community</h2>
                    <p class="text-gray-400 text-sm lg:text-md font-light">Start your personal style journey today</p>
                </div>
            </div>
        </div>

        {{-- Sisi Kanan: Form Sign Up --}}
        <div class="w-full md:w-1/2 bg-white flex flex-col items-center justify-center p-6 md:p-10">
            <div class="md:hidden mb-8">
                <h1 class="text-6xl font-serif text-brand-500 tracking-[0.2em]">vérso</h1>
            </div>

            <div class="w-full max-w-[380px]">
                <div class="text-center mb-8">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Sign Up</h3>
                    <p class="text-[9px] text-gray-400 uppercase tracking-[0.15em] leading-relaxed px-4">
                        Create an account to access exclusive features
                    </p>
                </div>

                <form wire:submit="register" class="space-y-4">
                    
                    {{-- 
                        CATATAN: Biasanya Register butuh Nama. 
                        Kalau di backend kamu wajib ada nama, tambahkan input nama di sini.
                        Tapi ini aku sesuaikan dengan kodemu yang cuma Email & Pass.
                    --}}

                    {{-- Input Email --}}
                    <div>
                        <label class="block text-[10px] font-bold text-gray-600 mb-1 uppercase tracking-widest">Email</label>
                        <input wire:model="email" type="email"
                        class="w-full px-5 py-2 rounded-xl border bg-gray-50 text-gray-800 outline-none transition-all text-sm
                        {{-- Logic Merah kalau Error --}}
                        @error('email') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-200 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] @enderror">
                        
                        {{-- Pesan Error (Email has been taken) --}}
                        @error('email') 
                            <span class="text-[10px] text-red-500 font-bold mt-1 block flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </span> 
                        @enderror
                    </div>

                    {{-- Input Password --}}
                    <div>
                        <label class="block text-[10px] font-bold text-gray-600 mb-1 uppercase tracking-widest">Password</label>
                        <input wire:model="password" type="password"
                        class="w-full px-5 py-2 rounded-xl border bg-gray-50 text-gray-800 outline-none transition-all text-sm
                        @error('password') border-red-500 focus:ring-red-200 bg-red-50 @else border-gray-200 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] @enderror">
                        
                        {{-- Pesan Error (Password too short, etc) --}}
                        @error('password') 
                            <span class="text-[10px] text-red-500 font-bold mt-1 block flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ $message }}
                            </span> 
                        @enderror
                    </div>

                    <div class="flex items-center justify-between text-[10px] text-gray-400 px-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox"
                            class="w-3.5 h-3.5 border border-gray-200 rounded-sm focus:ring-0 transition-all cursor-pointer">
                            <span>I agree to terms & conditions</span>
                        </label>
                    </div>

                    <x-button variant="solid" type="submit" class="w-full py-3 rounded-xl">
                        Sign Up
                    </x-button>

                    <div class="relative flex items-center py-2">
                        <div class="flex-grow border-t border-gray-100"></div>
                        <span class="flex-shrink mx-3 text-gray-300 text-[9px] font-bold uppercase tracking-widest">Or</span>
                        <div class="flex-grow border-t border-gray-100"></div>
                    </div>
                    
                    <a href="{{ route('google.login') }}">
                        <button type="button" 
                                class="w-full flex items-center justify-center gap-3 border border-gray-200 py-3 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition cursor-pointer">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                            Sign Up with Google
                        </button>
                    </a>
                </form>

                <p class="text-center text-xs text-gray-400 mt-6">
                    Have an account? <a href="{{ route('login') }}" class="font-bold text-brand-500 hover:underline underline-offset-4">Sign In</a>
                </p>
            </div>
        </div>
    </div>
</div>