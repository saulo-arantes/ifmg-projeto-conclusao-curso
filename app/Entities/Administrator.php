<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Administrator extends Model implements Transformable, AuditableContract
{
    use Auditable;
    use TransformableTrait;

    protected $fillable = [];

}
