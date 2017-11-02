<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class RegionValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class RegionValidator extends LaravelValidator
{
	protected $rules = [
		ValidatorInterface::RULE_CREATE => [],
		ValidatorInterface::RULE_UPDATE => [],
	];
}
