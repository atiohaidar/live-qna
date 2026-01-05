<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Event;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;

class EventPage extends Component
{
    public $event;
    public $newQuestion = '';
    public $userIdentifier;

    public function mount($slug, Request $request)
    {
        $this->event = Event::where('slug', $slug)->firstOrFail();
        $this->userIdentifier = $request->ip(); // Simple ID for voting
    }

    public function ask()
    {
        $this->validate([
            'newQuestion' => 'required|min:3|max:255',
        ]);

        $this->event->questions()->create([
            'content' => $this->newQuestion,
            'status' => 'pending', // Default pending moderation
        ]);

        $this->reset('newQuestion');
        session()->flash('message', 'Question sent! Waiting for approval.');
    }

    public function vote($questionId)
    {
        $existingVote = Vote::where('question_id', $questionId)
            ->where('user_identifier', $this->userIdentifier)
            ->first();

        if ($existingVote) {
            // Remove vote
            $existingVote->delete();
            Question::where('id', $questionId)->decrement('votes_count');
        } else {
            // Add vote
            Vote::create([
                'question_id' => $questionId,
                'user_identifier' => $this->userIdentifier,
            ]);
            Question::where('id', $questionId)->increment('votes_count');
        }
    }

    public function render()
    {
        $questions = $this->event->questions()
            ->approved()
            ->where('is_answered', false)
            ->orderByDesc('is_current') // Current question top
            ->orderByDesc('votes_count')
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.public.event-page', [
            'questions' => $questions
        ])->layout('components.layouts.app', ['title' => $this->event->title]);
    }
}
