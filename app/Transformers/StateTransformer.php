<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\State;

/**
 * Class StateTransformer
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Transformers;
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
