<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DoctorPatient
 *
 * @author Saulo Vinícius
 * @since 20/07/2017
 * @package App\Entities
 *
 * @property int id
 * @property int doctor_id
 * @property int patient_id
 * @property Doctor doctor
 * @property Patient patient
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class DoctorPatient extends Model implements Transformable, AuditableContract
{
	use Auditable;
	use TransformableTrait;

	protected $fillable = [
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
