<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int id
 * @property \DateTime start_at
 * @property \DateTime finish_at
 * @property int doctor_id
 * @property int patient_id
 * @property string description
 * @property int status
 * @property Doctor doctor
 * @property Patient patient
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Schedule extends Model implements Transformable {
	use TransformableTrait;

	const CREATED = 1;
	const CONFIRMED = 2;
	const CANCELED = 3;
	const ACCOMPLISHED = 4;

	protected $fillable = [
		'star_at',
		'finish_at',
		'status',
		'description',
		'doctor_id',
		'patient_id'
	];

	public function doctor()
	{
		return $this->hasOne(Doctor::class, 'id', 'doctor_id');
	}

	public function patient()
	{
		return $this->hasOne(Patient::class, 'id', 'patient_id');
	}
}
