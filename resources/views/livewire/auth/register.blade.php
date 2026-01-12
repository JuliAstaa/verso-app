{{-- Container utama tetap full screen --}}
<div class="fixed inset-0 bg-white flex items-center justify-center z-[9999] overflow-hidden">
    
    {{-- Card Utama dengan tinggi yang pas agar tidak muncul scrollbar --}}
    <div class="bg-white w-[95vw] h-[90vh] max-w-[1200px] max-h-[750px] overflow-hidden flex">
        
        <div class="w-1/2 bg-white flex flex-col">
            
            <div class="w-full flex justify-center">
                <h1 class="text-6xl font-serif text-brand-500 tracking-[0.2em] leading-none">vérso</h1>
            </div>

            <div class="flex-grow flex flex-col items-center justify-center">
                {{-- Ukuran gambar dikecilkan dikit agar komposisi pas --}}
                <img src="{{ asset('images/login/signUp.svg') }}" 
                        alt="Verso Illustration" 
                        class="w-full max-w-[500px] mx-auto">
                
                <div class="text-center px-4">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Elevate Your Everyday Style</h2>
                    <p class="text-gray-400 text-md font-light">Thoughtfully designed clothing for modern lifestyles</p>
                </div>
            </div>
        </div>

        <div class="w-1/2 bg-white flex flex-col items-center justify-center p-10">
            
            <div class="w-full max-w-[380px]">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-gray-800 mb-2">Sign Up</h3>
                    <p class="text-[9px] text-gray-400 uppercase tracking-[0.15em] leading-relaxed">
                        Sign up to access your guided meditations and personal journey
                    </p>
                </div>

                {{-- Form dengan spacing lebih rapat (space-y-4) --}}
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-600 mb-1 uppercase tracking-widest">Username</label>
                        <input type="text"
                        class="w-full px-5 py-2 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] outline-none transition-all text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-600 mb-1 uppercase tracking-widest">Password</label>
                        <input type="password"
                        class="w-full px-5 py-2 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] outline-none transition-all text-sm">
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold text-gray-600 mb-1 uppercase tracking-widest">Email</label>
                        <input type="email"
                        class="w-full px-5 py-2 rounded-xl border border-gray-200 bg-gray-50 text-gray-800 focus:bg-white focus:ring-2 focus:ring-[#634832]/20 focus:border-[#634832] outline-none transition-all text-sm">
                    </div>

                    <div class="flex items-center justify-between text-[10px] text-gray-400 px-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox"
                            class="w-3.5 h-3.5 appearance-none bg-white border border-gray-200 rounded-sm checked:bg-brand-500 checked:border-[#634832] focus:ring-0 transition-all cursor-pointer">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="hover:text-brand-500 underline underline-offset-4">Forgot Password?</a>
                    </div>

                    <button type="submit" 
                            class="w-full bg-brand-500 text-white py-4 mt-2 rounded-xl font-bold hover:bg-[#4d3827] transition-all active:scale-[0.98] cursor-pointer">
                        Sign Up
                    </button>

                    <div class="relative flex items-center py-2">
                        <div class="flex-grow border-t border-gray-100"></div>
                        <span class="flex-shrink mx-3 text-gray-300 text-[9px] font-bold uppercase tracking-widest">Or</span>
                        <div class="flex-grow border-t border-gray-100"></div>
                    </div>

                    <button type="button" 
                            class="w-full flex items-center justify-center gap-3 border border-gray-200 py-3 rounded-xl text-xs font-bold text-gray-600 hover:bg-gray-50 transition cursor-pointer">
                        <img src="https://www.svgrepo.com/show/355037/google.svg" class="w-4 h-4" alt="Google">
                        Sign In with Google
                    </button>
                </form>

                <p class="text-center text-xs text-gray-400 mt-6">
                    Have an account? <a href="{{ route('login') }}" class="font-bold text-brand-500 hover:underline underline-offset-4">Sign In</a>
                </p>
            </div>

        </div>
    </div>
</div>
