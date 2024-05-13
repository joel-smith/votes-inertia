<?php

namespace Tests\Notifications;

use App\Events\PollVoted;
use App\Models\Option;
use App\Models\Poll;
use App\Models\User;
use App\Notifications\PollVotedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class PollVotedNotificationTest extends TestCase
{

    use RefreshDatabase;

    public function test_it_sends_PollVoted_Notification()
    {
        Notification::fake();

        $user = User::factory()->create();
        $poll = Poll::factory()->create();
        $option = Option::factory()->create([
            'poll_id' => $poll->id
        ]);

        Event::dispatch(new PollVoted($user, $poll, $option));

        Notification::assertSentTo($user,function (PollVotedNotification $notification, $channels) use ($poll, $option) {
            return $notification->poll->id === $poll->id && $notification->option->id === $option->id;
        });

    }
}
