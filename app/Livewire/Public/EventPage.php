<?php

namespace App\Livewire\Public;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Event;
use App\Models\Question;
use App\Models\Vote;
use App\Events\QuestionCreated;
use App\Events\QuestionUpdated;
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

    // Listen for APPROVED question updates on public channel
    #[On('echo:event.{event.id},.QuestionUpdated')]
    public function refreshQuestions()
    {
        // Just refresh the component
    }

    public function ask()
    {
        $this->validate([
            'newQuestion' => 'required|min:3|max:255',
        ]);

        $status = $this->event->is_auto_approve ? 'approved' : 'pending';

        $question = $this->event->questions()->create([
            'content' => $this->newQuestion,
            'status' => $status,
        ]);

        // If auto-approved, broadcast as Updated (to public)
        if ($this->event->is_auto_approve) {
            QuestionUpdated::dispatch($question);
        } else {
            // Dispatch Event for Admin to see
            QuestionCreated::dispatch($question);
        }

        $this->reset('newQuestion');
        session()->flash('message', 'Question sent! Waiting for approval.');
    }

    public function vote($questionId)
    {
        $existingVote = Vote::where('question_id', $questionId)
            ->where('user_identifier', $this->userIdentifier)
            ->first();

        if ($existingVote) {
            $existingVote->delete();
            Question::where('id', $questionId)->decrement('votes_count');
        } else {
            Vote::create([
                'question_id' => $questionId,
                'user_identifier' => $this->userIdentifier,
            ]);
            Question::where('id', $questionId)->increment('votes_count');
        }

        // Notify everyone about new vote count
        QuestionUpdated::dispatch(Question::find($questionId));
    }

    public function render()
    {
        $questions = $this->event->questions()
            ->approved()
            ->where('is_answered', false)
            ->orderByDesc('is_current')
            ->orderByDesc('votes_count')
            ->orderByDesc('created_at')
            ->get();

        return view('livewire.public.event-page', [
            'questions' => $questions
        ])->layout('components.layouts.app', ['title' => $this->event->title]);
    }
}
