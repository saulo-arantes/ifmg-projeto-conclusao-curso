<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DocumentTypeValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name'        => 'required|string|max:30',
            'description' => 'required|string'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name'        => 'required|string|max:30',
            'description' => 'required|string'
        ],
   ];
}
