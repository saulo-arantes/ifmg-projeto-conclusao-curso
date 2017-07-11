<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
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
 * @property int naturalness_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Patients extends Model implements Transformable
{
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
        return $this->hasMany(PatientContact::class, 'patient_id', 'id');
    }

}
