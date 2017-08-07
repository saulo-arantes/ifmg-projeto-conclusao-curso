<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class DoctorPatientValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
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
