<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * @property int id
 * @property string description
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class UserContact extends Model implements Transformable
{
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