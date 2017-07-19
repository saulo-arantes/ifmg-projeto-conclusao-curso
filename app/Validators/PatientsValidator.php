<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class PatientsValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'                  => 'required|string|max:50',
            'photo'                 => 'nullable|max:255',
            'birthday_date'         => 'required|date|before:today',
            'sex'                   => 'required|string|in:m,s',
            'type'                  => 'nullable|integer|min:0|max:3',
            'cpf'                   => 'required|string|max:14',
            'rg'                    => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'neighborhood'          => 'required|string|max:255',
            'number'                => 'required|string|max:10',
            'complement'            => 'nullable|string|max:255',
            'zipcode'               => 'required|string|max:20',
            'allergic'              => 'required|boolean',
            'sus_card'              => 'nullable|string|max:25',
            'observation'           => 'nullable|string|max:400',
            'marital_status'        => 'nullable|integer|min:0|max:4',
            'height'                => 'nullable|numeric|min:0|max:2.5',
            'weight'                => 'nullable|numeric|min:0|max:300',
            'birth_height'          => 'nullable|numeric|min:0|max:0.5',
            'birth_weight'          => 'nullable|numeric|min:0|max:10',
            'birth_cephalic_length' => 'nullable|numeric|min:0|max:40',
            'birth_type'            => 'nullable|boolean',
            'blood_type'            => 'nullable|string|max:3',
            'father_id'             => 'integer|exists:patients,id',
            'mother_id'             => 'integer|exists:patients,id',
            'city_id'               => 'required|integer|exists:cities,id',
            'naturalness_id'        => 'required|integer|exists:cities,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'                  => 'required|string|max:50',
            'photo'                 => 'nullable|max:255',
            'birthday_date'         => 'required|date|before:today',
            'sex'                   => 'required|string|in:m,s',
            'type'                  => 'nullable|integer|min:0|max:3',
            'cpf'                   => 'required|string|max:14',
            'rg'                    => 'required|string|max:20',
            'address'               => 'required|string|max:255',
            'neighborhood'          => 'required|string|max:255',
            'number'                => 'required|string|max:10',
            'complement'            => 'nullable|string|max:255',
            'zipcode'               => 'required|string|max:20',
            'allergic'              => 'required|boolean',
            'sus_card'              => 'nullable|string|max:25',
            'observation'           => 'nullable|string|max:400',
            'marital_status'        => 'nullable|integer|min:0|max:4',
            'height'                => 'nullable|numeric|min:0|max:2.5',
            'weight'                => 'nullable|numeric|min:0|max:300',
            'birth_height'          => 'nullable|numeric|min:0|max:0.5',
            'birth_weight'          => 'nullable|numeric|min:0|max:10',
            'birth_cephalic_length' => 'nullable|numeric|min:0|max:40',
            'birth_type'            => 'nullable|boolean',
            'blood_type'            => 'nullable|string|max:3',
            'father_id'             => 'integer|exists:patients,id',
            'mother_id'             => 'integer|exists:patients,id',
            'city_id'               => 'required|integer|exists:cities,id',
            'naturalness_id'        => 'required|integer|exists:cities,id'
        ],
    ];
}
