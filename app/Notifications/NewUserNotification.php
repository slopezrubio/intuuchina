<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;

class NewUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $verification_urls;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notifiable)
    {
        $this->verification_urls = [
            'email' => URL::temporarySignedRoute('verification.email',
                Carbon::now()->addDays(Config::get('auth.verification.expire', 5)),
                ['id' => $notifiable->getKey(), 'program' => $notifiable->program->value, 'payment' => true]
            ),
            'checkout' => URL::temporarySignedRoute('verification.email',
                Carbon::now()->addDays(Config::get('auth.verification.expire', 5)),
                ['id' => $notifiable->getKey(), 'program' => $notifiable->program->value, 'payment' => true]
            ),
        ];
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
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->verification_urls);
        }

        return (new MailMessage)
            ->markdown(
            'vendor.notifications.new-user', ['user' => $notifiable, 'URLs' => $this->verification_urls]
            )
            ->subject(__('mails.new-user.subject', ['name' => $notifiable->name, 'program' => $notifiable->program->name]));

    }

    /**
     * Get the verification URLs for the given notifiable.
     *
     * @param  mixed  $notifiable
     * @return array
     */
//    protected function verificationUrls($notifiable)
//    {
//
//    }

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
