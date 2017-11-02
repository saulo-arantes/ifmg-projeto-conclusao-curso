<?php

namespace App\Transformers;

use App\Entities\ContactType;
use League\Fractal\TransformerAbstract;

/**
 * Class ContactTypeTransformer
 *
 * @author  Saulo Vinícius
 * @package namespace App\Transformers;
 */
class ContactTypeTransformer extends TransformerAbstract
{

	/**
	 * Transform the \ContactType entity
	 *
	 * @param ContactType $model
	 *
	 * @return array
	 */
	public function transform(ContactType $model)
	{
		return [
			'id'         => (int) $model->id,
			'name'       => $model->name,
			'created_at' => $model->created_at,
			'updated_at' => $model->updated_at
		];
	}
}
