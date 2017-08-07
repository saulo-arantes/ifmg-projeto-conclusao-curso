<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Log
 *
 * @author Saulo Vinícius
 * @since 30/05/2017
 * @package App\Entities
 *
 * @author Bruno Tomé
 * @property int id
 * @property int user_id
 * @property int type
 * @property bool visualized
 * @property string description
 * @property \DateTime created_at
 * @property \DateTime updated_at
 * @property User user
 */
class Log extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'description',
        'user_id',
        'type',
        'visualized'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
