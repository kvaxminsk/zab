<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public static function getCurrentUser()
    {
        return Auth::user();
    }

    public function isRoleAdmin()
    {
        return $this->hasRole('admin');
    }

    public function isRoleUser()
    {
        return $this->hasRole('user');
    }


    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized.');
    }

    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }

    public static function createBySocialProvider($providerUser)
    {
        $user = self::create([
            'email' => $providerUser->getEmail(),
            'username' => $providerUser->getNickname(),
            'password' => \Hash::make(str_random(8)),
            'name' => $providerUser->getName(),
        ]);
        $user
            ->roles()
            ->attach(Role::where('name', 'user')->first());
        return $user;
        //TODO вставить отправку письма на почту
    }
}
