<?php

namespace App\Mail;

use App\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReceivedMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $msg;
    public $title;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($msg)
    {
        $this->subject = $msg['subject'];
        $this->msg = $msg;
        $this->title = "Requested made by " . $msg['name'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if (Mail::failures()) {
            return view('pages/home');
        }

        $this->confirmation();

        return $this->view('emails.contact-us-email');
    }

    public function confirmation() {
        Mail::to($this->msg['email'])->queue(new ConfirmationEmailReceived($this->msg));
    }
}
