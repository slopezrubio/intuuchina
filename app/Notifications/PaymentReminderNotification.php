<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class PaymentReminderNotification extends Notification
{
    use Queueable;

    protected $reminder;
    protected $user;

    /**
     * Create a new notification instance.
     *
     * @param $reminder
     * @param $user
     */
    public function __construct($reminder, $user)
    {
        $this->user = $user;
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
            return __('mails.payment-reminder.'.$reminder, [
                'name' => $this->user->name,
                'program' => $this->user->program->name,
                'fee' => $this->user->categories !== null
                    ? $this->user->categories->first()->fee->name : $this->user->program->feeType->fees->first()->name,
                'amount' => $this->user->categories !== null
                    ? $this->user->categories->first()->fee->displayPriceTag() : $this->user->program->feeType->fees->first()->displayPriceTag()
            ]);
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
                        'action' => route('user.')
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
