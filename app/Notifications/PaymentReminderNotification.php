<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class PaymentReminderNotification extends Notification
{
    use Queueable;

    protected $reminder;

    /**
     * Create a new notification instance.
     *
     * @param $reminder
     */
    public function __construct($reminder)
    {
        $this->reminder = $this->setReminder($reminder);
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

    public function setReminder($reminder) {
        if (Lang::has('mails.payment-reminder.'.$reminder, app()->getLocale(), false)) {
            return __('mails.payment-reminder.'.$reminder);
        };

        return __('mails.payment-reminder.default');
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->markdown('vendor.notifications.payment-reminder', [
                        'user' => $notifiable,
                        'reminder' => $this->reminder,
                    ])
                    ->subject($this->reminder['subject']);
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
