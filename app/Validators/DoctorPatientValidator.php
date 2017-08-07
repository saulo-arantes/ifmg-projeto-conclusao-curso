<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class DoctorPatientValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'doctor_id'  => 'required|integer|exists:doctor,id',
            'patient_id' => 'required|integer|exists:patient,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'doctor_id'  => 'required|integer|exists:doctor,id',
            'patient_id' => 'required|integer|exists:patient,id'
        ],
    ];
}
