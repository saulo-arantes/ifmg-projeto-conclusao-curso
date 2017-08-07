<?php

namespace App\Transformers;

use App\Entities\State;
use League\Fractal\TransformerAbstract;

/**
 * Class StateTransformer
 *
 * @author  Bruno Tomé
 * @package namespace App\Transformers;
 */
class StateTransformer extends TransformerAbstract
{

    /**
     * Transform the \State entity
     *
     * @param State $model
     *
     * @return array
     */
    public function transform(State $model)
    {
        return [
            'id'       => (int)$model->id,
            'initials' => $model->initials,
            'name'     => $model->name,
            'region'   => [
                'id'         => $model->region->id,
                'name'       => $model->region->name,
                'pib'        => $model->region->pib,
                'population' => $model->region->population,
            ]
        ];
    }
}
