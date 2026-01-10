<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login Admin</h2>

        <form wire:submit="login">
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" wire:model="email" class="w-full border p-2 rounded mt-1">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" wire:model="password" class="w-full border p-2 rounded mt-1">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">
                <span wire:loading.remove>Masuk</span>
                <span wire:loading>Loading...</span>
            </button>
        </form>
    </div>
</div>