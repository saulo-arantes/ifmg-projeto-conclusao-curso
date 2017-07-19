<?php

namespace App\Transformers;

use App\Entities\Log;
use League\Fractal\TransformerAbstract;

/**
 * Class LogTransformer
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Transformers;
 */
class LogTransformer extends TransformerAbstract {

	protected $defaultIncludes = ['user'];

	/**
	 * Transform the \Log entity
	 *
	 * @param Log $model
	 *
	 * @return array
	 */
	public function transform(Log $model) {
		return [
			'id'          => (int) $model->id,
			'description' => $model->description,
			'created_at'  => $model->created_at,
			'updated_at'  => $model->updated_at
		];
	}

	public function includeUser(Log $model) {
		return $this->item($model->user, new UserTransformer());
	}
}
