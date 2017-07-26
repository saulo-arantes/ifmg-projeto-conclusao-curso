<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int id
 * @property int doctor_id
 * @property int patient_id
 * @property Doctor doctor
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

	public function doctor(){
		return $this->hasOne(Doctor::class, 'id', 'doctor_id');
	}

}