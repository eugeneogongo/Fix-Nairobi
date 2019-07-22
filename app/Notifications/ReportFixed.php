<?php

namespace FixNairobi\Notifications;

use FixNairobi\Problem;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\DB;

class ReportFixed extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $id;

    public function __construct($user, $id)
    {
        //
        $this->user = $user;
        $this->id = $id;
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
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $problem = DB::table('problems')->select('*')->where('id', '=', $this->id)->get();

        return (new MailMessage)
            ->from('info@fix.com', "FixNairobi Team")
            ->subject('Problem Fixed')
            ->line('Dear ' . $this->user->name . ', We have Fixed the Issue ' . $problem[0]->Title . ' you reported')
            ->line("Thank you for making Nairobi better!")
            ->action('Click Report Another Issue', url('/'));

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
