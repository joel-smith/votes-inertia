<?php

namespace App\Notifications;

use App\Models\Option;
use App\Models\Poll;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PollVotedNotification extends Notification
{
    use Queueable;

    public Poll $poll;
    public Option $option;

    /**
     * Create a new notification instance.
     */
    public function __construct(Poll $poll, Option $option)
    {
        $this->poll = $poll;
        $this->option = $option;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Thank you for your vote!')
                    ->line('You voted in the poll: ' . $this->poll->title)
                    ->line('You chose the option: ' . $this->option->value)
                    ->line('Thank you for using Votes!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
