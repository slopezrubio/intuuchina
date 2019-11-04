<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title = 'Welcome to IntuuChina';
    public $subject;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
        $this->subject = __('mails.subjects.new user ' . $user->program, ['name' => $user->name]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.new-user-confirmation');
    }
}
