<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'name', 'email', 'password', 'phone', 'role', 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function salary()
    {
        return $this->hasOne(salary::class);
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class);
    }
    public function managerTeam()
    {
        return $this->hasMany(managerTeam::class);
    }
}