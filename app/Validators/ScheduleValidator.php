<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ScheduleValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'start_at'    => 'required|date',
            'finish_at'   => 'required|date',
            'description' => 'nullable|string|max:255',
            'staus'       => 'required|integer|in:1,2,3,4',
            'doctor_id'   => 'required|integer|exists:doctors,id',
            'patient_id'  => 'required|integer|exists:patients,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'start_at'    => 'required|date',
            'finish_at'   => 'required|date',
            'description' => 'nullable|string|max:255',
            'staus'       => 'required|integer|in:1,2,3,4',
            'doctor_id'   => 'required|integer|exists:doctors,id',
            'patient_id'  => 'required|integer|exists:patients,id'
        ],
    ];
}
