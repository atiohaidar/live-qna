<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class Landing extends Component
{
    public $code = '';

    public function joinEvent()
    {
        $this->validate([
            'code' => 'required|string',
        ]);

        // Remove hash if user typed it
        $cleanCode = ltrim($this->code, '#');

        $event = Event::where('code', $cleanCode)->first();

        if ($event) {
            return redirect()->route('event.show', $event->slug);
        }

        $this->addError('code', 'Event not found. Please check the code.');
    }

    public function render()
    {
        return view('livewire.landing')->layout('components.layouts.app');
    }
}
