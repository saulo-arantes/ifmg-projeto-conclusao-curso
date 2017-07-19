<?php

namespace App\Transformers;

use App\Entities\Schedule;
use League\Fractal\TransformerAbstract;

/**
 * Class ScheduleTransformer
 * @package namespace App\Transformers;
 */
class ScheduleTransformer extends TransformerAbstract {

	/**
	 * Transform the \Schedule entity
	 *
	 * @param \Schedule $model
	 *
	 * @return array
	 */
	public function transform(Schedule $model) {
		return [
			'id' => (int) $model->id,

			/* place your other model properties here */

			'created_at' => $model->created_at,
			'updated_at' => $model->updated_at
		];
	}
}
