<?php

namespace App\Transformers;

use App\Entities\UserContact;
use League\Fractal\TransformerAbstract;

/**
 * Class UserContactTransformer
 *
 * @author  Saulo Vinícius
 * @package namespace App\Transformers;
 */
class UserContactTransformer extends TransformerAbstract
{

	/**
	 * Transform the \UserContact entity
	 *
	 * @param UserContact $model
	 *
	 * @return array
	 */
	public function transform(UserContact $model)
	{
		return [
			'id'              => (int) $model->id,
			'description'     => $model->description,
			'patient_id'      => $model->user_id,
			'contact_type_id' => $model->contact_type_id,
			'created_at'      => $model->created_at,
			'updated_at'      => $model->updated_at
		];
	}
}
