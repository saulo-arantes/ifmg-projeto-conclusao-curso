<?php

namespace App\Transformers;

use App\Entities\DocumentType;
use League\Fractal\TransformerAbstract;

/**
 * Class DocumentTypeTransformer
 * @package namespace App\Transformers;
 */
class DocumentTypeTransformer extends TransformerAbstract
{

	/**
	 * Transform the \DocumentType entity
	 *
	 * @param DocumentType $model
	 *
	 * @return array
	 */
	public function transform(DocumentType $model)
	{
		return [
			'id'          => (int) $model->id,
			'name'        => $model->name,
			'description' => $model->description,
			'created_at'  => $model->created_at,
			'updated_at'  => $model->updated_at
		];
	}
}
