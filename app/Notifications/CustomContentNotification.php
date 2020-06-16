<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomContentNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message, $attachments)
    {
        $this->message = $message;
        $this->attachments = $attachments;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->attachments !== null) {
            return (new MailMessage)
                ->markdown('vendor.notifications.minimal', [
                    'message' => $this->message,
                ])
                ->attach($this->attachments, [
                    'as' => $this->attachments->getClientOriginalName(),
                    'mime' => $this->attachments->getMimeType(),
                ])
                ->subject(__('content.about your program', ['program' => $notifiable->program->name]));
        }

        return (new MailMessage)
                    ->markdown('vendor.notifications.minimal', [
                        'message' => $this->message,
                    ])
                    ->subject(__('content.about your program', ['program' => $notifiable->program->name]));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
