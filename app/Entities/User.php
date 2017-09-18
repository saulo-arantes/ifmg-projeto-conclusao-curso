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
 * @property string complement
 * @property boolean status
 * @property string zipcode
 * @property string password
 * @property string role
 * @property UserContact contacts
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class User extends Authenticatable implements AuditableContract
{
    use Auditable;
    use Notifiable;

    const ADMIN = 'admin';
    const DOCTOR = 'doctor';
    const SECRETARY = 'secretary';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'complement',
        'email',
        'name',
        'neighborhood',
        'number',
        'password',
        'photo',
        'role',
        'status',
        'zipcode'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token'
    ];

    public function contacts()
    {
        return $this->hasMany(UserContact::class, 'user_id', 'id');
    }

    public static function getUserMiddleware()
    {
        return Auth::user()->role;
    }

	/**
	 * Checa se o usuário logado é do tipo ADMIN.
	 *
	 * @return bool
	 */
	public static function isAdmin()
	{
		return Auth::user()->role == User::ADMIN;
	}

	public static function allAdmins()
	{
		return (new User)->where('role', User::ADMIN)->get();
	}

	public static function isDoctor()
	{
		return Auth::user()->role == User::DOCTOR;
	}
}
