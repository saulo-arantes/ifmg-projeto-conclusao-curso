<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class DocumentType
 *
 * @author Saulo Vinícius
 * @since 19/10/2017
 * @package App\Entities
 *
 * @property int id
 * @property string name
 * @property string description
 * @property \DateTime created_at
 * @property \DateTime updated_at
 **/
class DocumentType extends Model implements Transformable
{
	use TransformableTrait;

	protected $fillable = [
		'name',
		'description'
	];

}
