<?php

namespace App\Notifications;

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
        foreach (__('content.programs') as $key => $program) {
            if ($key === $this->user->program && array_key_exists($key, __('mails.new-payment.body'))) {
                return trans_choice('mails.new-payment.body.' . $key . '.' . $this->invoice->metadata->course, $this->invoice->metadata->duration, ['user' => $this->user->name, 'amount' => numfmt_format_currency(numfmt_create(config('app.locale'), \NumberFormatter::CURRENCY), intval($this->invoice->amount_paid . 'e-2') , config('services.stripe.cashier_currency')), 'duration' => $this->invoice->metadata->duration]);
            }
        }

        return __('mails.new-payment.body.application-fee', ['user' => $this->user->name, 'amount' => numfmt_format_currency(numfmt_create(config('app.locale'), \NumberFormatter::CURRENCY), intval($this->invoice->amount . 'e-2') , config('services.stripe.cashier_currency'))]);
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
                                'description' => __('content.invoice.' . $this->user->program . '.description'),
                                'message' => $this->message
                            ]
                        )
                        ->subject(__('mails.new-payment.subject', ['user' => $this->user->name, 'program' => __('content.programs.' . $this->user->program)]));

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
