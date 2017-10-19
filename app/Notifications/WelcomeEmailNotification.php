<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Log;

class WelcomeEmailNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $email;

    private $password;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
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

    	return (new MailMessage)
		    ->subject('Bem-vindo!')
		    ->line('Olá! Bem-vindo ao nosso sistema de Gerenciamento de Consultas Médicas. Aqui está a sua senha:')
		    ->line('<b><h1>' . $this->password . '</h1></b>')
		    ->line('Essa senha foi gerada automaticamene e recomendamos que você a troque por uma nova.')
		    ->line('Lembre-se: nunca compartilhe sua senha com alguém. Aproveite o sistema!');
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
