<?php

namespace App\Notifications;

use App\Program;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewPaymentNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $invoice;
    protected $message;

    /**
     * Create a new notification instance.
     *
     * @param $user
     * @param $invoice
     */
    public function __construct($user, $invoice)
    {
        $this->user = $user;
        $this->invoice = $invoice;
        $this->message = $this->getMessage();
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
     * Get the corresponding email body.
     *
     * @return string
     */
    public function getMessage() {
        return trans_choice('mails.new-payment.body.' . $this->user->getFirstCategory()->fee->value, intval($this->invoice->lines->data[0]->quantity), [
            'user' => $this->user->name,
            'amount' => numfmt_format_currency(numfmt_create(config('app.locale'), \NumberFormatter::CURRENCY), floatval($this->invoice->amount_paid / 100), config('services.stripe.cashier_currency')),
            'program' => $this->user->program->name,
            'duration' =>  $this->invoice->lines->data[0]->quantity !== null ? $this->invoice->lines->data[0]->quantity : 1,
        ]);
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
                        ->markdown(
                            'vendor.notifications.admin.new-payment',
                            [
                                'user' => $this->user,
                                'total' => numfmt_format_currency(numfmt_create(config('app.locale'), \NumberFormatter::CURRENCY), floatval($this->invoice->amount_paid / 100), config('services.stripe.cashier_currency')),
                                'description' => $this->user->getFirstCategory()->fee->name,
                                'message' => $this->message
                            ]
                        )
                        ->subject(__('mails.new-payment.subject', [
                            'user' => $this->user->name,
                            'program' => $this->user->program->name,
                        ]));

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
