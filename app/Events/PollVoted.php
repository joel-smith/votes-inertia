<?php

namespace App\Events;

use App\Models\Option;
use App\Models\Poll;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PollVoted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public User $user;
    public Poll $poll;
    public Option $option;

    public function __construct(User $user, Poll $poll, Option $option)
    {
        $this->user = $user;
        $this->poll = $poll;
        $this->option = $option;
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
