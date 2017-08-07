<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int id
 * @property string description
 * @property int user_id
 * @property int contact_type_id
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class UserContact extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;

    protected $fillable = [
        'description',
        'user_id',
        'contact_type_id',
    ];

    public function contactType()
    {
        return $this->hasOne(ContactType::class, 'contact_type_id', 'id');
    }
}
