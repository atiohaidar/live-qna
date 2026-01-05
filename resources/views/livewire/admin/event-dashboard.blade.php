<div class="max-w-6xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 bg-white p-6 rounded-lg shadow">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ $event->title }}</h1>
            <p class="text-gray-500 text-sm">Dashboard Moderation • <a href="{{ route('admin.events') }}"
                    class="text-blue-500 hover:underline">Back to Events</a></p>
        </div>
        <div class="flex gap-4">
            <div class="text-center">
                <span class="block text-xl font-bold text-gray-800">{{ $event->questions()->count() }}</span>
                <span class="text-xs text-gray-500 uppercase">Total</span>
            </div>
            <div class="text-center border-l pl-4">
                <span
                    class="block text-xl font-bold text-green-600">{{ $event->questions()->approved()->count() }}</span>
                <span class="text-xs text-gray-500 uppercase">Live</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Incoming Column -->
        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 h-[calc(100vh-200px)] overflow-y-auto">
            <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                Incoming
                <span
                    class="ml-2 bg-gray-200 text-gray-600 px-2 py-0.5 rounded-full text-xs">{{ $pendingQuestions->count() }}</span>
            </h2>

            <div class="space-y-3">
                @forelse($pendingQuestions as $question)
                    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-100 animate-fade-in-up">
                        <p class="text-gray-800 mb-3">{{ $question->content }}</p>
                        <div class="flex gap-2">
                            <button wire:click="approve({{ $question->id }})"
                                class="flex-1 bg-green-500 text-white py-1 rounded hover:bg-green-600 transition text-sm font-semibold">
                                ✓ Approve
                            </button>
                            <button wire:click="reject({{ $question->id }})"
                                class="flex-1 bg-gray-200 text-gray-700 py-1 rounded hover:bg-gray-300 transition text-sm font-semibold">
                                ✕ Dismiss
                            </button>
                        </div>
                        <div class="mt-2 text-xs text-gray-400 text-center">
                            {{ $question->created_at->format('H:i') }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        No new questions.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Live Column -->
        <div class="bg-white p-4 rounded-xl border border-gray-200 h-[calc(100vh-200px)] overflow-y-auto">
            <h2 class="text-lg font-bold text-gray-700 mb-4 flex items-center">
                Live Q&A
                <span
                    class="ml-2 bg-green-100 text-green-600 px-2 py-0.5 rounded-full text-xs">{{ $liveQuestions->count() }}</span>
            </h2>

            <div class="space-y-3">
                @forelse($liveQuestions as $question)
                    <div
                        class="p-4 rounded-lg border transition-all {{ $question->is_current ? 'bg-blue-50 border-blue-400 ring-2 ring-blue-100' : 'bg-white border-gray-100 shadow-sm' }}">

                        @if($question->is_current)
                            <div class="text-xs font-bold text-blue-600 uppercase mb-2 flex items-center">
                                <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                                Currently Answering
                            </div>
                        @endif

                        <p class="text-gray-800 text-lg mb-2">{{ $question->content }}</p>

                        <div class="flex justify-between items-center mt-3">
                            <div class="flex items-center text-gray-500 text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7">
                                    </path>
                                </svg>
                                {{ $question->votes_count }} Votes
                            </div>

                            <div class="flex gap-2">
                                @if(!$question->is_current)
                                    <button wire:click="highlight({{ $question->id }})"
                                        class="text-blue-500 hover:bg-blue-50 px-3 py-1 rounded text-sm transition border border-blue-200">
                                        Highlight
                                    </button>
                                @else
                                    <button wire:click="unhighlight({{ $question->id }})"
                                        class="text-gray-500 hover:bg-gray-100 px-3 py-1 rounded text-sm transition">
                                        Un-Highlight
                                    </button>
                                @endif

                                <button wire:click="markAnswered({{ $question->id }})"
                                    class="text-green-600 hover:bg-green-50 px-3 py-1 rounded text-sm transition border border-green-200">
                                    Done
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400">
                        No live questions yet.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>