<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class UserValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class UserValidator extends LaravelValidator
{

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'address'      => 'required|string|max:255|',
			'complement'   => 'nullable|max:100',
			'email'        => 'required|email|unique:users,email|max:255',
			'role'         => 'required|string|in:admin,doctor,secretary',
			'name'         => 'required|string|max:255',
			'neighborhood' => 'required|string|max:100',
			'number'       => 'required|string|max:10',
			'password'     => 'required|confirmed|string|max:255|min:8',
			'photo'        => 'nullable|max:255',
			'status'       => 'boolean',
			'zipcode'      => 'required|string|size:9'
		],
		ValidatorInterface::RULE_UPDATE => [
			'address'      => 'required|string|max:255|',
			'complement'   => 'nullable|max:100',
			'email'        => 'required|email|unique:users,email|max:255',
			'name'         => 'required|string|max:255',
			'neighborhood' => 'required|string|max:100',
			'number'       => 'required|string|max:10',
			'photo'        => 'nullable|max:255',
			'status'       => 'boolean',
			'zipcode'      => 'required|string|size:9'
		],
	];
}
