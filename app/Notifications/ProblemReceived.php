<?php
/**
 * Developed by Eugene Ogongo on 7/22/19 7:02 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/22/19 7:01 PM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProblemReceived extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
            ->from('info@fix.com', "FixNairobi Team")
            ->subject('Problem Received')
            ->view('Mailing.problemReceived');
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
