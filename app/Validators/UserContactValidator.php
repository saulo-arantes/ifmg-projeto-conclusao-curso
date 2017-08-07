<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserContactValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class UserContactValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'description'     => 'required|string|max:150',
            'user_id'         => 'required|integer|exists:users,id',
            'contact_type_id' => 'required|integer|exists:contact_types,id'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'description'     => 'required|string|max:150',
            'user_id'         => 'required|integer|exists:users,id',
            'contact_type_id' => 'required|integer|exists:contact_types,id'
        ],
    ];
}
