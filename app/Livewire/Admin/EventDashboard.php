<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Event;
use App\Models\Question;
use App\Events\QuestionUpdated;

class EventDashboard extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    #[On('echo-private:event.admin.{event.id},.QuestionCreated')]
    #[On('echo-private:event.admin.{event.id},.QuestionUpdated')]
    public function refreshDashboard()
    {
        // Refresh component
    }

    public function approve($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->update(['status' => 'approved']);
            QuestionUpdated::dispatch($question);
        }
    }

    public function reject($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->update(['status' => 'hidden']);
            QuestionUpdated::dispatch($question);
        }
    }

    public function highlight($id)
    {
        // Un-highlight previous
        $this->event->questions()->update(['is_current' => false]);
        // Ideally should broadcast update for the unhighlighted one too, 
        // strictly speaking, but let's just highlight the new one which triggers refresh.
        // Actually, if we don't dispatch update for the OLD one, local state might be stale?
        // No, refreshQuestions() re-fetches all.

        // Highlight new
        $question = Question::find($id);
        if ($question) {
            $question->update(['is_current' => true]);
            QuestionUpdated::dispatch($question);
        }
    }

    public function unhighlight($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->update(['is_current' => false]);
            QuestionUpdated::dispatch($question);
        }
    }

    public function markAnswered($id)
    {
        $question = Question::find($id);
        if ($question) {
            $question->update(['is_answered' => true, 'is_current' => false]);
            QuestionUpdated::dispatch($question);
        }
    }

    public function render()
    {
        return view('livewire.admin.event-dashboard', [
            'pendingQuestions' => $this->event->questions()->pending()->latest()->get(),
            'liveQuestions' => $this->event->questions()
                ->approved()
                ->where('is_answered', false)
                ->orderByDesc('is_current')
                ->orderByDesc('votes_count')
                ->get(),
        ])->layout('components.layouts.app');
    }
}
