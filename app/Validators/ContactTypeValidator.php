<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class ContactTypeValidator extends LaravelValidator {

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'name' => 'required|string|max:30'
		],
		ValidatorInterface::RULE_UPDATE => [
			'name' => 'required|string|max:30'
		],
	];
}
