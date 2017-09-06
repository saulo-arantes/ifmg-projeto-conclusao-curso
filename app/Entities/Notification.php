<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Notification
 *
 * @author Saulo Vinícius
 * @since 30/05/2017
 * @package App\Entities
 *
 * @property int id
 * @property int user_id
 * @property int type
 * @property bool visualized
 * @property string description
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @property User user
 */
class Notification extends Model
{

	use TransformableTrait;

	const ERROR = 'BaseLaravel\Notifications\DeniedNotification';
	const INFO = 'BaseLaravel\Notifications\InfoNotification';
	const DENIED = 'BaseLaravel\Notifications\DeniedNotification';
	const VALIDATOR = 'BaseLaravel\Notifications\ValidatorExceptionNotification';

	/**
	 * Update the notifications count to display into the badges.
	 */
	public static function updateBadges()
	{
		$notificationsNotVisualized = (new Notification)
			->where('notifiable_id', Auth::user()->id)
			->whereNull('read_at')
			->get();

		$notificationsValidatorsCount = (new Notification)
			->where('notifiable_id', Auth::user()->id)
			->whereNull('read_at')
			->where('type', Notification::VALIDATOR)
			->count();

		$notificationsErrorsCount = (new Notification)
			->where('notifiable_id', Auth::user()->id)
			->whereNull('read_at')
			->where('type', Notification::ERROR)
			->count();

		$notificationsDeniedCount = (new Notification)
			->where('notifiable_id', Auth::user()->id)
			->whereNull('read_at')
			->where('type', Notification::DENIED)
			->count();

		$notificationsInfoCount = (new Notification)
			->where('notifiable_id', Auth::user()->id)
			->whereNull('read_at')
			->where('type', Notification::INFO)
			->count();

		$notificationsTransformed = [];
		$notificationsTransformed[] = '<span style="margin: 5px;" class="btn btn-xs btn-warning center-block">Validator <small class="pull-right">' . $notificationsValidatorsCount . '</small></span>';
		$notificationsTransformed[] = '<span style="margin: 5px;" class="btn btn-xs btn-danger center-block">Exception <small class="pull-right">' . $notificationsErrorsCount . '</small></span>';
		$notificationsTransformed[] = '<span style="margin: 5px;" class="btn btn-xs btn-warning center-block">Denied <small class="pull-right">' . $notificationsDeniedCount . '</small></span>';
		$notificationsTransformed[] = '<span style="margin: 5px;" class="btn btn-xs btn-info center-block">Info <small class="pull-right">' . $notificationsInfoCount . '</small></span>';

		session([
			'notificationsNotVisualized'      => $notificationsTransformed,
			'notificationsNotVisualizedCount' => count($notificationsNotVisualized),
		]);
	}
}
