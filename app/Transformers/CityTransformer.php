<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\City;

/**
 * Class CityTransformer
 *
 * @author  Bruno Tomé
 * @package namespace App\Transformers;
 */
class CityTransformer extends TransformerAbstract
{
    /**
     * Transform the \City entity
     *
     * @param City $model
     *
     * @return array
     */
    public function transform(City $model)
    {
        return [
            'id'         => (int)$model->id,
            'name'       => $model->name,
            'population' => $model->population,
            'state'      => [
                'id'       => $model->state->id,
                'name'     => $model->state->name,
                'initials' => $model->state->initials,
                'region'   => [
                    'id'         => $model->state->region->id,
                    'name'       => $model->state->region->name,
                    'pib'        => $model->state->region->pib,
                    'population' => $model->state->region->population,
                ],
            ],
        ];
    }
}
