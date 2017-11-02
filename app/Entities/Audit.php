<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Audit
 *
 * @author Saulo Vinícius
 * @since 07/08/2017
 * @package App\Entities
 *
 * @property string old_values
 * @property string new_values
 * @property \DateTime created_at
 * @property User user
 */
class Audit extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
