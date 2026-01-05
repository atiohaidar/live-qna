<div class="max-w-2xl mx-auto py-8 px-4">
    <!-- Header -->
    <div class="text-center mb-8">
        <div class="text-sm font-bold text-blue-600 uppercase tracking-wide">Q&A Session</div>
        <h1 class="text-3xl font-extrabold text-gray-900 mt-2">{{ $event->title }}</h1>
        <div class="text-gray-500 mt-2 text-sm">
            {{ $event->start_date?->format('F j, Y') }} • Code: #{{ $event->code }}
        </div>
    </div>

    <!-- Ask Box -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8 border border-gray-100 sticky top-4 z-10">
        <form wire:submit.prevent="ask">
            <div class="relative">
                <textarea wire:model="newQuestion"
                    class="w-full p-4 border border-gray-200 rounded-lg bg-gray-50 focus:bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 transition resize-none text-gray-700"
                    rows="2" placeholder="Type your question here..." maxlength="255"></textarea>
                <div class="text-right mt-2 flex justify-between items-center">
                    <span class="text-xs text-gray-400">Max 255 chars</span>
                    <button type="submit"
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold shadow hover:bg-blue-700 transition transform hover:-translate-y-0.5">
                        Send
                    </button>
                </div>
            </div>
        </form>
        @if (session()->has('message'))
            <div class="mt-3 p-3 bg-green-50 text-green-700 text-sm rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                {{ session('message') }}
            </div>
        @endif
    </div>

    <!-- Questions List -->
    <div class="space-y-4" wire:poll.5s> <!-- Auto refresh every 5s -->
        @forelse($questions as $question)
            <div
                class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex gap-4 transition hover:shadow-md {{ $question->is_current ? 'ring-2 ring-blue-400 bg-blue-50' : '' }}">
                <!-- Vote Section -->
                <div class="flex flex-col items-center min-w-[3rem]">
                    <button wire:click="vote({{ $question->id }})"
                        class="group flex flex-col items-center space-y-1 focus:outline-none">
                        @php
                            $hasVoted = $question->votes()->where('user_identifier', $userIdentifier)->exists();
                        @endphp
                        <svg class="w-6 h-6 transition {{ $hasVoted ? 'text-blue-600 fill-current' : 'text-gray-400 group-hover:text-blue-500' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                        <span class="font-bold text-lg {{ $hasVoted ? 'text-blue-600' : 'text-gray-600' }}">
                            {{ $question->votes_count }}
                        </span>
                    </button>
                </div>

                <!-- Content -->
                <div class="flex-1">
                    @if($question->is_current)
                        <div class="text-xs font-bold text-blue-600 uppercase mb-1 flex items-center">
                            <span class="w-2 h-2 bg-blue-600 rounded-full mr-2 animate-pulse"></span>
                            Live Now
                        </div>
                    @endif
                    <p class="text-gray-800 text-lg leading-relaxed">{{ $question->content }}</p>
                    <div class="text-gray-400 text-xs mt-3 flex justify-between items-center">
                        <span>{{ $question->created_at->diffForHumans() }}</span>
                        <span class="text-gray-300">#{{ $question->id }}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <div class="bg-gray-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                </div>
                <h3 class="text-gray-500 font-medium">No questions yet</h3>
                <p class="text-gray-400 text-sm mt-1">Be the first to ask something!</p>
            </div>
        @endforelse
    </div>
</div>