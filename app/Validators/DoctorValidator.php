<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class DoctorValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'crm' => 'required|string|size:13'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'crm' => 'required|string|size:13'
        ],
    ];
}
