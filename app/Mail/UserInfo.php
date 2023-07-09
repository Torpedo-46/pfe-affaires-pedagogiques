<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $pwd;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pwd,User $user)
    {
        //
        $this->pwd=$pwd;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('noreply@localhost')
            ->view('emails.info');
    }
}
