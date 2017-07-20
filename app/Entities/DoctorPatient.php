<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property integer id
 * @property integer doctor_id
 * @property integer patient_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class DoctorPatient extends Model implements Transformable 
{
	use TransformableTrait;

	protected $fillable = [
		'doctor_id',
		'patient_id'
	];

}
