<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verso - Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

<div class="container">
    <div class="min-h-screen flex bg-[#fdfbf8]">
        <!-- LEFT SECTION -->
        <div class="hidden md:flex w-1/2 flex-col justify-center px-20">
            <img
                src="{{ asset('assets/illustration.png') }}"
                alt="Illustration"
                class="max-w-md mb-8"
            >

            <h1 class="font-serif text-3xl mb-2 text-gray-900">
                Elevate Your Everyday Style
            </h1>

            <p class="text-gray-600 max-w-md">
                Thoughtfully designed clothing for modern lifestyles
            </p>
        </div>

        <!-- RIGHT SECTION -->
        <div class="w-full md:w-1/2 flex items-center justify-center">
            <div class="w-[380px] border border-gray-400 rounded-xl p-8 bg-white">

                <h2 class="text-center font-serif text-2xl mb-2 text-gray-900">
                    Sign Up
                </h2>

                <p class="text-center text-sm text-gray-600 mb-6">
                    Sign up to access your guided meditations, daily practices,
                    and personal journey
                </p>

                <!-- FORM -->
                <form wire:submit.prevent="register" class="space-y-4">

                    <div>
                        <label class="text-sm text-gray-700">
                            Username
                        </label>
                        <input
                            type="text"
                            wire:model.defer="username"
                            name="username"
                            placeholder="Enter your username"
                            class="w-full mt-1 px-3 py-2 border rounded-md
                                focus:outline-none focus:ring-1 focus:ring-[#6b4e3d]"
                        >
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">
                            Password
                        </label>
                        <input
                            type="password"
                            wire:model.defer="password"
                            name="password"
                            placeholder="Enter your password"
                            class="w-full mt-1 px-3 py-2 border rounded-md
                                focus:outline-none focus:ring-1 focus:ring-[#6b4e3d]"
                        >
                    </div>

                    <div>
                        <label class="text-sm text-gray-700">
                            Email
                        </label>
                        <input
                            type="email"
                            wire:model.defer="email"
                            name="email"
                            placeholder="Enter your email"
                            class="w-full mt-1 px-3 py-2 border rounded-md
                                focus:outline-none focus:ring-1 focus:ring-[#6b4e3d]"
                        >
                    </div>

                    <div class="flex justify-between items-center text-xs text-gray-600">
                        <label class="flex items-center gap-1">
                            <input
                                type="checkbox"
                                wire:model.defer="remember"
                            >
                            Remember me
                        </label>

                        <a href="#" class="text-[#6b4e3d] hover:underline">
                            Forgot Password?
                        </a>
                    </div>

                    <button
                        type="submit"
                        class="w-full bg-[#6b4e3d] text-white py-2 rounded-md
                            hover:opacity-90 transition"
                    >
                        Sign Up
                    </button>

                    <div class="text-center text-xs text-gray-400 my-3">
                        Or
                    </div>

                    <button
                        type="button"
                        class="w-full flex items-center justify-center gap-2
                            border py-2 rounded-md hover:bg-gray-50 transition"
                    >
                        <img
                            src="https://www.svgrepo.com/show/475656/google-color.svg"
                            class="w-4"
                            alt="Google"
                        >
                        Sign in with Google
                    </button>

                    <p class="text-center text-xs mt-4 text-gray-600">
                        Have an account?
                        <a href="#" class="text-[#6b4e3d] hover:underline">
                            Sign In
                        </a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>