<?php

namespace App\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class User
 *
 * @author Saulo Vinícius
 * @since 30/05/2017
 * @package App\Entities
 *
 * @property integer id
 * @property string address
 * @property string email
 * @property string photo
 * @property string name
 * @property string neighborhood
 * @property string number
 * @property boolean status
 * @property string zipcode
 * @property int level
 * @property UserContact contacts
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class User extends Authenticatable implements AuditableContract
{
    use Auditable;
    use Notifiable;

    const ADMIN = 0;
    const DOCTOR = 1;
    const SECRETARY = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'complement',
        'email',
        'level',
        'name',
        'neighborhood',
        'number',
        'password',
        'photo',
        'status',
        'zipcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function contacts()
    {
        return $this->hasMany(UserContact::class, 'user_id', 'id');
    }

    public static function getUserMiddleware()
    {
        switch (Auth::user()->level) {
            case User::ADMIN:
                return 'admin';
            case User::DOCTOR:
                return 'doctor';
            case User::SECRETARY:
                return 'secretary';
            default:
                return 'secretary';
        }
    }
}
