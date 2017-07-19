<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class LogValidator extends LaravelValidator {

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'user_id'     => 'required|integer|exists:users,id',
			'description' => 'required|string',
			'type'        => 'required|integer|min:0|max:2'
		],
		ValidatorInterface::RULE_UPDATE => [],
	];
}
