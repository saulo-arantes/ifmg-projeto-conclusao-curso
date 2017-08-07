<?php

namespace App\Transformers;

use App\Entities\Patient;
use League\Fractal\TransformerAbstract;

/**
 * Class PatientsTransformer
 *
 * @author  Saulo Vinícius
 * @package namespace App\Transformers;
 */
class PatientsTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'city',
        'naturalness',
        'contacts'
    ];

    /**
     * Transform the Patients entity
     *
     * @param Patient $model
     *
     * @return array
     */
    public function transform(Patient $model)
    {
        return [
            'id'                    => (int)$model->id,
            'name'                  => $model->name,
            'photo'                 => $model->photo,
            'birthday_date'         => $model->birthday_date,
            'sex'                   => $model->sex,
            'type'                  => $model->type,
            'cpf'                   => $model->cpf,
            'rg'                    => $model->rg,
            'address'               => $model->address,
            'neighborhood'          => $model->neighborhood,
            'number'                => $model->number,
            'complement'            => $model->complement,
            'zipcode'               => $model->zipcode,
            'allergic'              => $model->allergic,
            'sus_card'              => $model->sus_card,
            'observation'           => $model->observation,
            'marital_status'        => $model->marital_status,
            'height'                => $model->height,
            'weight'                => $model->weight,
            'birth_height'          => $model->birth_height,
            'birth_weight'          => $model->birth_weight,
            'birth_cephalic_length' => $model->birth_cephalic_length,
            'birth_type'            => $model->birth_type,
            'blood_type'            => $model->blood_type,
            'father_id'             => $model->father_id,
            'mother_id'             => $model->mother_id,
            'city_id'               => $model->city_id,
            'naturalness_id'        => $model->naturalness_id,
            'created_at'            => $model->created_at,
            'updated_at'            => $model->updated_at
        ];
    }

    public function includeCity(Patient $model)
    {

        if (!empty($model->city)) {

            return $this->item($model->city, new CityTransformer());
        }

        return null;
    }

    public function includeNaturalness(Patient $model)
    {

        if (!empty($model->naturalness)) {

            return $this->item($model->naturalness, new CityTransformer());
        }

        return null;
    }

    public function includeContacts(Patient $model)
    {
        if (!empty($model->contacts)) {

            return $this->collection($model->contacts, new PatientContactTransformer());
        }

        return null;
    }
}
