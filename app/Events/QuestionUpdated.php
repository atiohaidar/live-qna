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

class QuestionUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $question;

    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    public function broadcastOn()
    {
        $channels = [
            new PrivateChannel('event.admin.' . $this->question->event_id),
        ];

        // If approved and not hidden, broadcast to public
        if ($this->question->status === 'approved') {
            $channels[] = new Channel('event.' . $this->question->event_id);
        }

        return $channels;
    }

    public function broadcastAs()
    {
        return 'QuestionUpdated';
    }
}
