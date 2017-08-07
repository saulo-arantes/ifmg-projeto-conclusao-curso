<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Region
 *
 * @author Bruno Tomé
 * @property int id
 * @property string name
 * @property double pib
 * @property int population
 */
class Region extends Model implements Transformable, AuditableContract {
    use Auditable;
	use TransformableTrait;

	public $timestamps = false;
	protected $fillable = [];

}
