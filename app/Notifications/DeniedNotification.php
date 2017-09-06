<?php

namespace BaseLaravel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class DeniedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $url;

    /**
     * Create a new notification instance.
     *
     * @param $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array
     */
    public function via()
    {
        return [
            'database'
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail()
    {
        return (new MailMessage)
            ->error()
            ->line('Usuário com id #' . Auth::user()->id . ' tentou a url ' . $this->url)
            ->action('Acessar o sistema', url(env('APP_URL')));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'message' => 'Usuário com id #' . Auth::user()->id . ' tentou a url ' . $this->url
        ];
    }
}