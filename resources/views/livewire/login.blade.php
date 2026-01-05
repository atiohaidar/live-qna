<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 bg-gray-800 text-white">
            <h2 class="text-2xl font-bold text-center">Admin Login</h2>
        </div>

        <form wire:submit.prevent="login" class="px-8 py-6">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                    Email Address
                </label>
                <input wire:model="email" type="email" id="email"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                    placeholder="admin@example.com">
                @error('email') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                    Password
                </label>
                <input wire:model="password" type="password" id="password"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror"
                    placeholder="******************">
                @error('password') <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> @enderror

                <div class="flex items-center">
                    <input wire:model="remember" type="checkbox" id="remember" class="mr-2 leading-tight">
                    <label class="text-sm text-gray-600" for="remember">
                        Remember Me
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full transition duration-150 ease-in-out">
                    Sign In
                </button>
            </div>
        </form>
    </div>
</div>