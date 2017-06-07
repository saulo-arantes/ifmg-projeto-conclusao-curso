<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class City
 *
 * @author Bruno Tomé
 * @property int id
 * @property string name
 * @property int population
 * @property int state_id
 * @property State state
 */
class City extends Model implements Transformable
{
    use TransformableTrait;

    public $timestamps = false;
    protected $fillable = [];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

}
