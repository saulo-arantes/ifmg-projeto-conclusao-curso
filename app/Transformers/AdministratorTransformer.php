<?php

namespace App\Transformers;

use App\Entities\Administrator;
use League\Fractal\TransformerAbstract;

/**
 * Class AdministratorTransformer
 * @package namespace App\Transformers;
 */
class AdministratorTransformer extends TransformerAbstract {

	/**
	 * Transform the \Administrator entity
	 *
	 * @param \Administrator $model
	 *
	 * @return array
	 */
	public function transform(Administrator $model) {
		return [
			'id' => (int) $model->id,

			/* place your other model properties here */

			'created_at' => $model->created_at,
			'updated_at' => $model->updated_at
		];
	}
}
