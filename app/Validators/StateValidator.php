<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class StateValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class StateValidator extends LaravelValidator
{
	protected $rules = [
		ValidatorInterface::RULE_CREATE => [],
		ValidatorInterface::RULE_UPDATE => [],
	];
}
