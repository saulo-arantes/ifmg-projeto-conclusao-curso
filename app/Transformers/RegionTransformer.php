<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Region;

/**
 * Class RegionTransformer
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Transformers;
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
            'id'         => (int)$model->id,
            'name'       => $model->name,
            'pib'        => $model->pib,
            'population' => $model->population,
        ];
    }
}
