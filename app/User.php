<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    /**
     * User has roles
     */
    public function roles() {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

   /**
     * 
     * @param string|array $roles
     * 
     */
    public function authorizeRoles($roles)
    {
        if(is_array($roles))
        {
            return $this->hasAnyRole($roles) || 
                abort(401, 'Error 401, This action is unauthorized.');
        }
        return $this->hasRole($roles) || 
            abort(401, 'Error 401, This action is unauthorized.');
    }

    /**
     * 
     * Check the user has more roles.
     * @param string $roles
     * 
     */
    public function hasAnyRole($roles)
    {
        if(is_array($roles))
        {
            foreach($roles as $role)
            {
                if($this->hasRole($role))
                {
                    return true;
                }
            }
        }
        else
        {
            if($this->hasRole($roles))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * 
     * Check one role
     * @param string $role
     * 
     */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
