<?php

namespace App\Transformers;

use App\Entities\User;
use League\Fractal\TransformerAbstract;

/**
 * Class LogTransformer
 *
 * @author  Saulo Vinícius
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{
	protected $defaultIncludes = ['contacts'];

	/**
	 * Transform the User entity
	 *
	 * @param User $model
	 *
	 * @return array
	 */
	public function transform(User $model)
	{
		return [
			'id'           => (int) $model->id,
			'address'      => $model->address,
			'email'        => $model->email,
			'name'         => $model->name,
			'neighborhood' => $model->neighborhood,
			'number'       => $model->number,
			'complement'   => $model->complement,
			'password'     => $model->password,
			'photo'        => $model->photo,
			'status'       => $model->status,
			'role'         => $model->role,
			'zipcode'      => $model->zipcode,
			'created_at'   => $model->created_at,
			'updated_at'   => $model->updated_at
		];
	}

	public function includeContacts(User $model)
	{
		if (!empty($model->contacts)) {
			return $this->collection($model->contacts, new UserContactTransformer());
		}

		return null;
	}
}
