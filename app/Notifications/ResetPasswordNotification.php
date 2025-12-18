<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    public $token;
    public $email;

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = config('app.frontend_url')
            . '/auth/reset-password/'
            . $this->token
            . '?email=' . urlencode($this->email);

        return (new MailMessage)
            ->subject('Pix Coders – Password Reset Notification')
            ->line('You are receiving this email because we received a password reset request for your Pix Coders Community account.')
            ->action('Reset Password', $url)
            ->line('If you did not request a password reset, no further action is required.')
            ->line('Thank you for being part of the Pix Coders Community!');
    }
}
