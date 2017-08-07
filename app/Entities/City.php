<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class City
 *
 * @author Saulo Vinícius
 * @since 07/06/2017
 * @package App\Entities
 *
 * @property int id
 * @property string name
 * @property int population
 * @property int state_id
 * @property State state
 */
class City extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;

    public $timestamps = false;
    protected $fillable = [];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
