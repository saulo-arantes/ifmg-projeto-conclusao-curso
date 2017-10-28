<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Secretary
 *
 * @author Saulo Vinícius
 * @since 28/10/2017
 * @package App\Entities
 *
 * @property integer id
 * @property integer user_id
 * @property User user
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Secretary extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['user_id'];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

}
