<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Status;
use App\StudentNotification;

class NotifyStudent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $notifyStudent ;
    public function __construct(StudentNotification $notifyStudent)
    {
        $this->notifyStudent = $notifyStudent;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['status-change','teacher-acceptance'];
    }
}
