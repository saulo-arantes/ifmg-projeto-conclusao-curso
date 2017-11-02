<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

/**
 * Class ScheduleValidator
 *
 * @author  Saulo Vinícius
 * @package namespace App\Validators;
 */
class ScheduleValidator extends LaravelValidator
{

	protected $rules = [
		ValidatorInterface::RULE_CREATE => [
			'start_at'    => 'required|date',
			'finish_at'   => 'required|date',
			'type'        => 'nullable|boolean',
			'description' => 'nullable|string|max:255',
			'status'      => 'nullable|integer|in:1,2,3,4',
			'doctor_id'   => 'nullable|integer|exists:doctors,id',
			'patient_id'  => 'nullable|integer|exists:patients,id'
		],
		ValidatorInterface::RULE_UPDATE => [
			'start_at'    => 'required|date',
			'finish_at'   => 'required|date',
			'type'        => 'nullable|boolean',
			'description' => 'nullable|string|max:255',
			'status'      => 'nullable|integer|in:1,2,3,4',
			'doctor_id'   => 'nullable|integer|exists:doctors,id',
			'patient_id'  => 'nullable|integer|exists:patients,id'
		],
	];
}
