<?php

namespace App\Transformers;

use App\Entities\Secretary;
use League\Fractal\TransformerAbstract;

/**
 * Class SecretaryTransformer
 * @package namespace App\Transformers;
 */
class SecretaryTransformer extends TransformerAbstract
{

	/**
	 * Transform the Secretary entity
	 *
	 * @param Secretary $model
	 *
	 * @return array
	 */
	public function transform(Secretary $model)
	{
		return [
			'id' => (int) $model->id,

			'user_id' => $model->user_id,

			'created_at' => $model->created_at,
			'updated_at' => $model->updated_at
		];
	}
}
