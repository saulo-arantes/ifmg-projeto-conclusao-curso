<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Patient
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Entities
 *
 * @property int id
 * @property string name
 * @property string photo
 * @property \DateTime birthday_date
 * @property string sex
 * @property int type
 * @property string cpf
 * @property string rg
 * @property string address
 * @property string neighborhood
 * @property string number
 * @property string complement
 * @property string zipcode
 * @property boolean allergic
 * @property string sus_card
 * @property string observation
 * @property string marital_status
 * @property float height
 * @property float weight
 * @property float birth_height
 * @property float birth_weight
 * @property float birth_cephalic_length
 * @property float birth_type
 * @property string blood_type
 * @property int father_id
 * @property int mother_id
 * @property int city_id
 * @property City city
 * @property City naturalness
 * @property PatientContact contacts
 * @property DoctorPatient doctors
 * @property int naturalness_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Patient extends Model implements Transformable, AuditableContract
{
	use Auditable;
	use TransformableTrait;

	protected $fillable = [
		'name',
		'photo',
		'birthday_date',
		'sex',
		'type',
		'cpf',
		'rg',
		'address',
		'neighborhood',
		'number',
		'complement',
		'zipcode',
		'allergic',
		'sus_card',
		'observation',
		'marital_status',
		'blood_type',
		'height',
		'weight',
		'birth_height',
		'birth_weight',
		'birth_cephalic_length',
		'birth_type',
		'father_id',
		'mother_id',
		'city_id',
		'naturalness_id'
	];

	public function contacts()
	{
		return $this->hasMany(PatientContact::class);
	}

	public function naturalness()
	{
		return $this->belongsTo(City::class, 'naturalness_id', 'id');
	}

	public function city()
	{
		return $this->belongsTo(City::class, 'city_id', 'id');
	}

	public function doctors()
	{
		return $this->hasMany(DoctorPatient::class, 'patient_id', 'id');
	}

}
