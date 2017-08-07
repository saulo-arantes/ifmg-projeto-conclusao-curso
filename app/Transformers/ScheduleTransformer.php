<?php

namespace App\Transformers;

use App\Entities\Schedule;
use League\Fractal\TransformerAbstract;

/**
 * Class ScheduleTransformer
 * @package namespace App\Transformers;
 */
class ScheduleTransformer extends TransformerAbstract
{

    /**
     * Transform the \Schedule entity
     *
     * @param Schedule $model
     *
     * @return array
     */
    public function transform(Schedule $model)
    {
        return [
            'id'          => (int)$model->id,
            'start_at'    => $model->start_at,
            'finish_at'   => $model->finish_at,
            'description' => $model->description,
            'status'      => $model->status,
            'doctor_id'   => $model->doctor_id,
            'patient_id'  => $model->patient_id,
            'created_at'  => $model->created_at,
            'updated_at'  => $model->updated_at
        ];
    }
}
