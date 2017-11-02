<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class DoctorValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class DoctorValidator extends LaravelValidator
{

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'crm' => 'string|size:13'
		],
		ValidatorInterface::RULE_UPDATE => [
			'crm' => 'required|string|size:13'
		],
	];
}
