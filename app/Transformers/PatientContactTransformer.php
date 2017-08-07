<?php

namespace App\Transformers;

use App\Entities\PatientContact;
use League\Fractal\TransformerAbstract;

/**
 * Class PatientContactTransformer
 * @package namespace App\Transformers;
 */
class PatientContactTransformer extends TransformerAbstract
{

    /**
     * Transform the \PatientContact entity
     *
     * @param PatientContact $model
     *
     * @return array
     */
    public function transform(PatientContact $model)
    {
        return [
            'id'              => (int)$model->id,
            'description'     => $model->description,
            'patient_id'      => $model->patient_id,
            'contact_type_id' => $model->contact_type_id,
            'created_at'      => $model->created_at,
            'updated_at'      => $model->updated_at
        ];
    }
}
