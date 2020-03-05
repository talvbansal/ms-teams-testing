<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\MsTeams\MsTeamsChannel;
use NotificationChannels\MsTeams\MsTeamsMessage;

class PolicyPlaced extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [MsTeamsChannel::class];
    }

    public function toMsTeams($notifiable)
    {
        $url = url('/home');

        return MsTeamsMessage::create()
            // Optional recipient user id.
            ->to(config('services.ms-teams.webhook_url'))
            // Markdown supported.
            ->title('Policy Placed')
            ->content("A new policy has been placed")
            // (Optional) Inline Buttons
            ->button('View Policy', $url)
            // (Optional) Supporting images
            ->image('https://source.unsplash.com/random/800x800?billing&q='.now());
    }
}
