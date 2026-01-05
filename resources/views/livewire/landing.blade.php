<div class="min-h-[80vh] flex flex-col justify-center items-center">
    <div class="text-center mb-10">
        <h1 class="text-5xl font-extrabold text-blue-600 mb-4 tracking-tight">Slido Clone</h1>
        <p class="text-gray-500 text-lg">Real-time Q&A for your meetings and events.</p>
    </div>

    <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
        <form wire:submit.prevent="joinEvent">
            <label class="block text-gray-700 font-bold mb-3 text-lg">Enter Event Code</label>
            <div class="flex gap-2">
                <span
                    class="bg-gray-100 text-gray-500 text-2xl font-bold p-3 rounded-l border border-r-0 border-gray-300 flex items-center">#</span>
                <input wire:model="code" type="text"
                    class="w-full border-2 border-gray-300 p-3 rounded-r text-2xl font-bold uppercase tracking-widest text-gray-700 focus:outline-none focus:border-blue-500 focus:ring-0 placeholder-gray-300"
                    placeholder="CODE">
            </div>
            @error('code') <p class="text-red-500 mt-2 text-sm">{{ $message }}</p> @enderror

            <button type="submit"
                class="w-full bg-blue-600 text-white text-xl font-bold py-4 rounded-xl mt-6 hover:bg-blue-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Join Event →
            </button>
        </form>
    </div>

    <div class="mt-12 text-center space-y-2">
        <p class="text-gray-400 text-sm">Organizing an event?</p>
        <div>
            <a href="{{ route('login') }}" class="text-blue-500 font-semibold hover:underline">Login as Admin</a>
        </div>
        <div class="pt-4">
            <a href="/python-demo" class="text-purple-600 font-medium hover:text-purple-700 transition flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                View Python Integration Demo
            </a>
        </div>
    </div>

</div>