<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property integer id
 * @property string crm
 * @property User user
 * @property DoctorPatient patients
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Doctor extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;

    protected $fillable = ['crm'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patients()
    {
        return $this->hasMany(DoctorPatient::class, 'doctor_id', 'id');
    }

}
