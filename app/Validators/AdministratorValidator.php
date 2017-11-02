<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class AdministratorValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class AdministratorValidator extends LaravelValidator
{

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [],
		ValidatorInterface::RULE_UPDATE => [],
	];
}
