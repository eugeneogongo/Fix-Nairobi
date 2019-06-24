<?php

namespace FixNairobi\Mail;

use App\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BulkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $template, $subject;

    /**
     * Create a new message instance.
     *
     * @param Template $template
     */
    public function __construct($template, $subject)
    {
        $this->template = $template;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->from("odera.eugene@students.jkuat.ac.ke", "Emergency Group - Fix Nairobi")->view('Mailing.BulkEmail')->with(['content' => $this->template]);
    }

}
