<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class PaymentNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $title = "User Payment Notification";
    public $intent;

    /**
     * Create a new message instance.
     *
     * @param $user
     * @param $intent
     */
    public function __construct($user, $intent)
    {
        $this->user = $user->name;
        $this->intent = $intent;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user-payment-notification');
    }
}