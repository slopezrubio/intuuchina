<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Hash;

class NewUserNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $checkout_url;
    public $title = 'Welcome to IntuuChina';
    public $subject;


    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param Checkout $stripeSession
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->subject = __('mails.subjects.new user ' . $user->program, ['name' => $user->name ]);
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
