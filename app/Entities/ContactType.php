<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class ContactType
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Entities
 *
 * @property int id
 * @property string name
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class ContactType extends Model implements Transformable, AuditableContract
{
	use Auditable;
	use TransformableTrait;

	protected $fillable = [
		'name'
	];

}
