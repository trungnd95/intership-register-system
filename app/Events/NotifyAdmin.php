<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\NotificationAdmin;

class NotifyAdmin extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $notifyAdmin;

    public function __construct(NotificationAdmin $notifyAdmin)
    {
        $this->notifyAdmin = $notifyAdmin;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notify-admin'];
    }
}
