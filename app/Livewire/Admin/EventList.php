<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Event;
use Illuminate\Support\Str;

class EventList extends Component
{
    public $title = '';
    public $code = '';
    public $isCreating = false;

    protected $rules = [
        'title' => 'required|min:3',
        'code' => 'nullable|alpha_dash|unique:events,code',
    ];

    public function create()
    {
        $this->validate();

        Event::create([
            'title' => $this->title,
            'slug' => Str::slug($this->title) . '-' . Str::random(6),
            'code' => $this->code,
            'start_date' => now(),
        ]);

        $this->reset(['title', 'code', 'isCreating']);
    }

    public function delete($id)
    {
        Event::find($id)->delete();
    }

    public function render()
    {
        return view('livewire.admin.event-list', [
            'events' => Event::latest()->get(),
        ])->layout('components.layouts.app');
    }
}
