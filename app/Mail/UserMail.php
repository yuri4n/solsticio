<?php

namespace Solsticio\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserMail extends Mailable
{
    use Queueable, SerializesModels;
     
    /**
     * The userObj object instance.
     *
     * @var UserObj
     */
    public $userObj;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userObj)
    {
        $this->userObj = $userObj;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('bryangarzon22@gmail.com')
                    ->view('mails.user')
                    ->text('mails.user_plain');
    }
}