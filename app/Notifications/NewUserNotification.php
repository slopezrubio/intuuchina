<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class NewUserNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

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
        $verificationUrls = $this->verificationUrls($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrls);
        }

        return (new MailMessage)
            ->markdown(
            'vendor.notifications.new-user', ['user' => $notifiable, 'verificationURLs' => $verificationUrls]
            )
            ->subject(__('mails.new-user.subject', ['name' => $notifiable->name, 'program' => __('content.programs.' . $notifiable->program)]));

    }

    /**
     * Get the verification URLs for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    protected function verificationUrls($notifiable)
    {
        return [
            'email' => URL::temporarySignedRoute('verification.email',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                ['id' => $notifiable->getKey()]
            ),
            'checkout' => URL::temporarySignedRoute('verification.email',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                ['id' => $notifiable->getKey(), 'program' => $notifiable->program, 'payment' => true ]
            ),
        ];


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
