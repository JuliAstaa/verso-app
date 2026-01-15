    {{-- Container utama --}}
    <div x-data="{ showBackendError: {{ ($errors->any() || session('error')) ? 'true' : 'false' }} }" 
        class="fixed inset-0 bg-white flex items-center justify-center z-[9999] overflow-y-auto md:overflow-hidden font-poppins p-4">
        
        {{-- Card Utama --}}
        <div class="bg-white w-full md:h-[90vh] max-w-[1200px] max-h-[750px] flex flex-col md:flex-row ">
            
            {{-- Sisi Kiri: Ilustrasi --}}
            <div class="hidden md:flex md:w-1/2 bg-white flex-col py-8">  
                <div class="w-full flex justify-center">
                    <h1 class="text-4xl lg:text-6xl font-serif text-brand-500 tracking-[0.2em] leading-none">vérso</h1>
                </div>
                <div class="flex-grow flex flex-col items-center justify-center">
                    <img src="{{ asset('images/login/signUp.svg') }}" alt="Verso Illustration" class="w-full max-w-[400px] lg:max-w-[500px] mx-auto">
                    <div class="text-center px-4">
                        <h2 class="text-xl lg:text-2xl font-bold text-gray-800 mb-2">Elevate Your Everyday Style</h2>
                        <p class="text-gray-400 text-sm lg:text-md font-light">Thoughtfully designed clothing for modern lifestyles</p>
                    </div>
                </div>
            </div>

            {{-- Sisi Kanan: Form Login --}}
            <div class="w-full md:w-1/2 bg-white flex flex-col items-center justify-center p-6 md:p-10">
                <div class="md:hidden mb-8">
                    <h1 class="text-6xl font-serif text-brand-500 tracking-[0.2em]">vérso</h1>
                </div>

                <div class="w-full max-w-[380px]">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Sign In</h3>
                        <p class="text-[9px] text-gray-400 uppercase tracking-[0.15em] leading-relaxed">
                            Sign in to access your guided meditations and personal journey
                        </p>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-4 md:space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold text-gray-600 mb-1.5 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" class="w-full px-5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-600 mb-1.5 uppercase tracking-widest">Password</label>
                            <input type="password" name="password" class="w-full px-5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-brand-500/20 focus:border-brand-500 outline-none transition-all text-sm">
                        </div>

                        <div class="flex items-center justify-between text-[10px] text-gray-400 px-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" class="w-3.5 h-3.5 border border-gray-200 rounded-sm focus:ring-0 transition-all cursor-pointer">
                                <span>Remember me</span>
                            </label>
                            <a href="#" class="hover:text-brand-500 underline underline-offset-4">Forgot Password?</a>
                        </div>

                        <x-button variant="solid" type="submit" class="w-full py-3  rounded-xl">
                            Log In
                        </x-button>

                        <div class="relative flex items-center py-2 md:py-3">
                            <div class="flex-grow border-t border-gray-100"></div>
                            <span class="flex-shrink mx-4 text-gray-300 text-[9px] font-bold uppercase tracking-widest">Or</span>
                            <div class="flex-grow border-t border-gray-100"></div>
                        </div>

                        <button type="button" class="w-full flex items-center justify-center gap-3 border border-gray-200 py-3 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition cursor-pointer">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                            Sign In with Google
                        </button>
                    </form>

                    <p class="text-center text-xs text-gray-400 mt-6 md:mt-8">
                        Don't have an account? <a href="{{ route('register') }}" class="font-bold text-brand-500 hover:underline underline-offset-4">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>

        {{-- MODAL POP-UP ERROR HANDLER (Melayang di atas semua elemen) --}}
        <div x-show="showBackendError" 
            class="fixed inset-0 z-[10000] flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
            x-cloak>
            
            <div @click.away="showBackendError = false" 
                class="bg-white rounded-3xl max-w-sm w-full p-8 text-center border border-gray-100 shadow-2xl transition-all">
                
                {{-- Icon Warning --}}
                <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>

                <h3 class="text-xl font-bold text-gray-800 mb-2">
                    {{ session('error') ? 'Access Denied' : 'Login Failed' }}
                </h3>

                <div class="text-sm text-gray-500 leading-relaxed mb-8">
                    @if (session('error'))
                        {{ session('error') }}
                    @else
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <x-button
                        variant="solid"
                        @click="showBackendError = false" 
                        class="w-full py-4 text-sm font-bold !rounded-xl !no-underline">
                    Understood
                </x-button>
            </div>
        </div>
    </div>