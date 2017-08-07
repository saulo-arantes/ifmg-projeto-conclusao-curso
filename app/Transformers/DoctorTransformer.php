<?php

namespace App\Transformers;

use App\Entities\Doctor;
use League\Fractal\TransformerAbstract;

/**
 * Class DoctorTransformer
 * @package namespace App\Transformers;
 */
class DoctorTransformer extends TransformerAbstract
{

    /**
     * Transform the \Doctor entity
     *
     * @param Doctor $model
     *
     * @return array
     */
    public function transform(Doctor $model)
    {
        return [
            'id'         => (int)$model->id,
            'crm'        => $model->crm,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
