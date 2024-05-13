<?php

namespace App\Listeners;

use App\Events\PollVoted;
use App\Notifications\PollVotedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PollVotedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PollVoted $event): void
    {
        $event->user->notify(new PollVotedNotification($event->poll, $event->option));
    }
}
