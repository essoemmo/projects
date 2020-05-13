<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    private $code;
    private $isAdmin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code ,$isAdmin=0)
    {
        $this->code = $code;
        $this->isAdmin  = $isAdmin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.reset', ['code' => $this->code,'isAdmin' => $this->isAdmin]);
    }
}
