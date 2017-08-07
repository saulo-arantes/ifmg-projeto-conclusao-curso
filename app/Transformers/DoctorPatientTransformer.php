<?php

namespace App\Transformers;

use App\Entities\DoctorPatient;
use League\Fractal\TransformerAbstract;

/**
 * Class DoctorPatientTransformer
 * @package namespace App\Transformers;
 */
class DoctorPatientTransformer extends TransformerAbstract
{

    /**
     * Transform the \DoctorPatient entity
     *
     * @param DoctorPatient $model
     *
     * @return array
     */
    public function transform(DoctorPatient $model)
    {
        return [
            'id'         => (int)$model->id,
            'doctor_id'  => $model->doctor_id,
            'patient_id' => $model->patient_id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
