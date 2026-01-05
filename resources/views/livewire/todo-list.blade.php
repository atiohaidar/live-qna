<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-gray-800 text-center">My Todo List</h1>

    <div class="mb-6 flex gap-2">
        <input type="text" wire:model="content" wire:keydown.enter="add"
            class="flex-1 p-2 border border-gray-300 rounded focus:outline-none focus:border-blue-500"
            placeholder="Add a new task...">
        <button wire:click="add"
            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 focus:outline-none transition">
            Add
        </button>
    </div>
    @error('content') <span class="text-red-500 text-sm block mb-4">{{ $message }}</span> @enderror

    <ul class="space-y-3">
        @foreach($todos as $todo)
            <li class="flex items-center justify-between p-3 bg-gray-50 rounded hover:bg-gray-100 transition">
                <div class="flex items-center gap-3 cursor-pointer select-none" wire:click="toggle({{ $todo->id }})">
                    <div
                        class="w-5 h-5 border-2 border-gray-400 rounded flex items-center justify-center transition-colors {{ $todo->is_completed ? 'bg-green-500 border-green-500' : '' }}">
                        @if($todo->is_completed)
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        @endif
                    </div>
                    <span class="{{ $todo->is_completed ? 'line-through text-gray-400' : 'text-gray-700' }}">
                        {{ $todo->content }}
                    </span>
                </div>
                <button wire:click="delete({{ $todo->id }})" class="text-red-400 hover:text-red-600 transition p-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                </button>
            </li>
        @endforeach
    </ul>

    @if($todos->isEmpty())
        <div class="text-center text-gray-400 mt-6 italic">
            No tasks yet. Time to get productive!
        </div>
    @endif
</div>