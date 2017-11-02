<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ValidatorExceptionNotification extends Notification implements ShouldQueue
{
	use Queueable;

	private $file;
	private $line;
	private $message;

	/**
	 * Create a new notification instance.
	 *
	 * @param $file
	 * @param $line
	 * @param $message
	 */
	public function __construct($file, $line, $message)
	{
		$this->file    = $file;
		$this->line    = $line;
		$this->message = $message;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @return array
	 */
	public function via()
	{
		return ['database'];
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @return array
	 */
	public function toArray()
	{
		return [
			'message' => '<b>Arquivo:</b> ' . $this->file .
			             '<br><b>Linha:</b> ' . $this->line .
			             '<br><b>Mensagem:</b> ' . $this->message
		];
	}
}