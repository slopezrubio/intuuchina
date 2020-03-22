<?php

namespace App\Mail;

use App\Notifications\QueryReceivedNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class QueryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public $query;
    public $sending;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->query = $data['subject'];
        $this->sending = [
            'name' => $data['name'],
            'email' => $data['email']
        ];
    }

    /**
     * Build the message.
     *
     * @return QueryReceived
     */
    public function build()
    {
        if (Mail::failures()) {
            return view('pages/home');
        }

        Notification::route('mail', $this->sending['email'])
                        ->notify(new QueryReceivedNotification());



        return $this->from(config('mail.from.address'))
                    ->subject(__('mails.visitor-query.subject', ['name' => $this->sending['name']]))
                    ->markdown('emails.visitor-query')
                    ->with([
                        'message' => __('mails.visitor-query.body'),
                        'queryDetails' => [
                            'name' => $this->sending['name'],
                            'email' => $this->sending['email'],
                            'query' => $this->query
                        ]
                    ]);
    }
}
