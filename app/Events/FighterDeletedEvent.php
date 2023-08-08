<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FighterDeletedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $deleted_id;
    public $dojo_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($deleted_id, $dojo_id)
    {
        $this->deleted_id = $deleted_id;
        $this->dojo_id = $dojo_id;
    }


    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
