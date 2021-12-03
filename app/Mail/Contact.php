<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $msg)
    {
        $this->msg  = $msg;
        $this->user = auth()->user();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("sys@app.oralcorp.com.br")
                    ->subject("Form de contat")
                    ->markdown("emails.contact");
    }
}
