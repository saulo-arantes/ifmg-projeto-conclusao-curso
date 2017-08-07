<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PatientContact
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Entities
 *
 * @property int id
 * @property string description
 * @property int patient_id
 * @property int contact_type_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class PatientContact extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;

    protected $fillable = [
        'description',
        'patient_id',
        'contact_type_id'
    ];

    public function contactType()
    {
        return $this->hasOne(ContactType::class, 'contact_type_id', 'id');
    }


}
