<?php

namespace App\Events;

use App\Models\Question;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class QuestionCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function broadcastOn()
    {
        \Log::info('Broadcasting QuestionCreated for Event: ' . $this->question->event_id);
        // New questions are pending, so only Admin sees them
        return new PrivateChannel('event.admin.' . $this->question->event_id);
    }

    public function broadcastAs()
    {
        return 'QuestionCreated';
    }
}
