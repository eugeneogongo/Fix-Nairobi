<?php

namespace FixNairobi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class RegisterSuccess extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->success()
            ->from('info@fix.com', "FixNairobi Team")
            ->subject('Welcome')
            ->line('Dear ' . $this->user->name . ', We are glad to see you here.')
            ->line('Thank you for joining FixNairobi!')
            ->line("We shall make Nairobi City Great Again! Together")
            ->action('To Report Issues', url('/'))
            ->line('Please spread the news');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
