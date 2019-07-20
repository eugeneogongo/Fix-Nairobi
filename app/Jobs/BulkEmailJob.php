<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Jobs;

use App\Mail\SendMail;
use FixNairobi\Mail\BulkMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BulkEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $sendto = "", $subject = "";
    protected $template = "";

    /**
     * SendEmailTest constructor.
     * @param $sendto
     * @param $template
     * @param $subject
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getSendto()
    {
        return $this->sendto;
    }

    /**
     * @param mixed $sendto
     */
    public function setSendto($sendto)
    {
        $this->sendto = $sendto;
    }

    public function fail($exception = null)
    {
        print_r($exception);
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template)
    {
        $this->template = $template;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $email = new BulkMail($this->template, $this->subject);
            Mail::to($this->sendto)
                ->send($email);
        } catch (Exception $e) {
            // bird is clearly not the word
            print_r($e->getMessage());
        }


    }
}
