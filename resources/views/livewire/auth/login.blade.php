<x-layouts.auth>
    {{-- Container utama --}}
    <div class="fixed inset-0 bg-[#F3F4F6] flex items-center justify-center z-[9999] overflow-hidden">
        
        {{-- Card Utama: Ukuran 1200x750 --}}
        <div class="bg-white w-[95vw] h-[90vh] max-w-[1200px] max-h-[750px] shadow-2xl flex rounded-[40px] overflow-hidden border border-gray-100">
            
            <div class="w-1/2 bg-[#FDFCFB] flex flex-col p-12 border-r border-gray-50">
                
                <div class="w-full flex justify-center mb-6">
                    <h1 class="text-5xl font-serif text-[#634832] tracking-[0.2em] leading-none">vérso</h1>
                </div>

                <div class="flex-grow flex flex-col items-center justify-center">
                    <img src="{{ asset('images/login/signUp.svg') }}" 
                         alt="Verso Illustration" 
                         class="w-full max-w-[380px] mx-auto mb-8">
                    
                    <div class="text-center px-4">
                        <h2 class="text-3xl font-bold text-gray-800 mb-2">Elevate Your Everyday Style</h2>
                        <p class="text-gray-400 text-lg font-light">Thoughtfully designed clothing for modern lifestyles</p>
                    </div>
                </div>
            </div>

            <div class="w-1/2 bg-white flex flex-col items-center justify-center p-10">
                
                <div class="w-full max-w-[380px]">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-bold text-gray-800 mb-2">Sign In</h3>
                        <p class="text-[9px] text-gray-400 uppercase tracking-[0.15em] leading-relaxed">
                            Sign in to access your guided meditations and personal journey
                        </p>
                    </div>

                    <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label class="block text-[10px] font-bold text-gray-600 mb-1.5 uppercase tracking-widest">Username</label>
                            <input type="text" name="username" 
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] outline-none transition-all text-sm">
                        </div>

                        <div>
                            <label class="block text-[10px] font-bold text-gray-600 mb-1.5 uppercase tracking-widest">Password</label>
                            <input type="password" name="password" 
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] outline-none transition-all text-sm">
                        </div>

                        <div class="flex items-center justify-between text-[10px] text-gray-400 px-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" 
                                class="w-3.5 h-3.5 appearance-none bg-white border border-gray-200 rounded-sm checked:bg-[#634832] checked:border-[#634832] focus:ring-0 transition-all cursor-pointer">
                                <span>Remember me</span>
                            </label>
                            <a href="#" class="hover:text-[#634832] underline underline-offset-4">Forgot Password?</a>
                        </div>

                        <button type="submit" 
                                class="w-full bg-[#634832] text-white py-4 mt-2 rounded-2xl font-bold hover:bg-[#4d3827] shadow-xl shadow-[#634832]/20 transition-all active:scale-[0.98] cursor-pointer">
                            Log In
                        </button>

                        <div class="relative flex items-center py-3">
                            <div class="flex-grow border-t border-gray-100"></div>
                            <span class="flex-shrink mx-4 text-gray-300 text-[9px] font-bold uppercase tracking-widest">Or</span>
                            <div class="flex-grow border-t border-gray-100"></div>
                        </div>

                        <button type="button" 
                                class="w-full flex items-center justify-center gap-3 border border-gray-200 py-3.5 rounded-2xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition cursor-pointer">
                            <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                            Sign In with Google
                        </button>
                    </form>

                    <p class="text-center text-xs text-gray-400 mt-8">
                        Don't have an account? <a href="{{ route('register') }}" class="font-bold text-[#634832] hover:underline underline-offset-4">Sign Up</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-layouts.auth>
