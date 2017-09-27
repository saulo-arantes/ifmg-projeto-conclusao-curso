<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;

	/**
	 * The password reset token.
	 *
	 * @var string
	 */
	public $token;

	private $email;

	/**
	 * Create a notification instance.
	 *
	 * @param  string $token
	 * @param $email
	 */
	public function __construct($token, $email)
	{
		$this->token = $token;
		$this->email = $email;
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
		    ->subject('Redefinição de senha')
		    ->line('Você está recebendo esse email pois recebemos uma requisição para redefinição de senha para a sua conta.')
		    ->action('Redefinir senha', url(config('app.url') . route('password.reset', $this->token, false)))
		    ->line('Se você não solicitou uma redefinição de senha, nenhuma ação é necessária.');
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
