<div class="max-w-4xl mx-auto py-10 px-4">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">My Events</h1>
        <button wire:click="$toggle('isCreating')"
            class="bg-blue-600 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition">
            {{ $isCreating ? 'Cancel' : '+ New Event' }}
        </button>
    </div>

    @if($isCreating)
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <form wire:submit.prevent="create">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Event Title</label>
                        <input wire:model="title" type="text" class="w-full border p-2 rounded focus:outline-blue-500">
                        @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Event Code (Optional)</label>
                        <input wire:model="code" type="text" class="w-full border p-2 rounded focus:outline-blue-500"
                            placeholder="e.g. QNA-01">
                        @error('code') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">Create
                    Event</button>
            </form>
        </div>
    @endif

    <div class="grid gap-4">
        @foreach($events as $event)
            <div class="bg-white p-6 rounded-lg shadow hover:shadow-md transition flex justify-between items-center">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                    <div class="text-sm text-gray-500 mt-1">
                        Code: <span class="font-mono bg-gray-100 px-2 py-0.5 rounded">{{ $event->code ?? 'N/A' }}</span>
                        <span class="mx-2">•</span>
                        {{ $event->created_at->format('d M Y') }}
                    </div>
                    <div class="text-xs text-blue-500 mt-2">
                        Admin Link: <a href="{{ route('admin.dashboard', $event->id) }}" class="underline">Manage Q&A</a>
                    </div>
                    <div class="text-xs text-green-500 mt-1">
                        Public Link: <a href="{{ url('/e/' . $event->slug) }}" target="_blank"
                            class="underline">{{ url('/e/' . $event->slug) }}</a>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.dashboard', $event->id) }}"
                        class="bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200">
                        Enter
                    </a>
                    <button wire:click="delete({{ $event->id }})" class="text-red-400 hover:text-red-600 p-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        @endforeach

        @if($events->isEmpty())
            <div class="text-center text-gray-400 py-10">
                No events found. Create one to get started!
            </div>
        @endif
    </div>

    <div class="mt-8 border-t pt-4 text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-red-500 text-sm hover:underline">Logout</button>
        </form>
    </div>
</div>