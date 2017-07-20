<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property integer id
 * @property string crm
 * @property User user
 * @property Patient patients
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Doctor extends Model implements Transformable
{
	use TransformableTrait;

	protected $fillable = ['crm'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function patients()
	{
		return $this->hasMany(Patient::class, 'patient_id', 'id');
	}

}
