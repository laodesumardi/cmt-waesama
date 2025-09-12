<?php

namespace App\Events;

use App\Models\LetterRequest;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LetterRequestCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $letterRequest;

    /**
     * Create a new event instance.
     */
    public function __construct(LetterRequest $letterRequest)
    {
        $this->letterRequest = $letterRequest;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}