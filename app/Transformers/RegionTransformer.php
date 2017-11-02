<?php

namespace App\Transformers;

use App\Entities\Region;
use League\Fractal\TransformerAbstract;

/**
 * Class RegionTransformer
 *
 * @author  Saulo Vinícius
 * @package namespace App\Transformers;
 */
class RegionTransformer extends TransformerAbstract
{

	/**
	 * Transform the \Region entity
	 *
	 * @param Region $model
	 *
	 * @return array
	 */
	public function transform(Region $model)
	{
		return [
			'id'         => (int) $model->id,
			'name'       => $model->name,
			'pib'        => $model->pib,
			'population' => $model->population,
		];
	}
}
