<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use App\Models\Question;

class EventDashboard extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function approve($id)
    {
        Question::where('id', $id)->update(['status' => 'approved']);
    }

    public function reject($id)
    {
        Question::where('id', $id)->update(['status' => 'hidden']);
    }

    public function highlight($id)
    {
        // Un-highlight previous
        $this->event->questions()->update(['is_current' => false]);

        // Highlight new
        Question::where('id', $id)->update(['is_current' => true]);
    }

    public function unhighlight($id)
    {
        Question::where('id', $id)->update(['is_current' => false]);
    }

    public function markAnswered($id)
    {
        Question::where('id', $id)->update(['is_answered' => true, 'is_current' => false]);
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
