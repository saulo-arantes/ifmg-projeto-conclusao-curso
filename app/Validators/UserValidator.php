<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'address'=>'required|string|max:255|',
            'complement' => 'string|max:100',
            'email'=> 'required|email|unique:users,email|max:255',
            'level' => 'required|integer|in:0,1,2',
            'name' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:100',
            'number' => 'required|string|max:10',
            'password'=>'required|confirmed|string|max:255|min:8',
            'photo' => 'nullable|max:255',
            'status' => 'boolean',
            'zipcode' => 'required|string|size:9'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'address'=>'required|string|max:255|',
            'complement' => 'string|max:100',
            'email'=> 'required|email|unique:users,email|max:255',
            'level' => 'integer|in:0,1,2',
            'name' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:100',
            'number' => 'required|string|max:10',
            'password'=>'required|confirmed|string|max:255|min:8',
            'photo' => 'nullable|max:255',
            'status' => 'boolean',
            'zipcode' => 'required|string|size:9'
        ],
    ];
}
