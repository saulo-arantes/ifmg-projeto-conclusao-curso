<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class CityValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class CityValidator extends LaravelValidator
{
	protected $rules = [
		ValidatorInterface::RULE_CREATE => [],
		ValidatorInterface::RULE_UPDATE => [],
	];
}
