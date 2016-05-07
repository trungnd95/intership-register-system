<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\TeacherNotification;

class NotifyTeacher extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    
    public $notifyTeacher;
    public function __construct(TeacherNotification $notifyTeacher )
    {
        $this->notifyTeacher = $notifyTeacher;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['teacher-notify'];
    }
}
