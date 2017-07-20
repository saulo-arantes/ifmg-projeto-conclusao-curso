<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class State
 *
 * @author Saulo Vinícius
 * @property int id
 * @property string initials
 * @property string name
 * @property int region_id
 * @property Region region
 */
class State extends Model implements Transformable
{
	use TransformableTrait;

	public $timestamps = false;
	protected $fillable = [];

	public function region()
	{
		return $this->belongsTo(Region::class);
	}

	public function cities()
	{
		return $this->hasMany(City::class, 'state_id', 'id');
	}

}
