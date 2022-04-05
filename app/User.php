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
    public function insert()
    {
    }
    public static function getAll()
    {
        $users = User::get();
        return $users;
    }
    public static function getById($id)
    {
        $user = User::find($id);
        return $user;
    }
    public static function edit($id, $name, $email, $phone, $role)
    {
        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->role = $role;
        $user->update();
    }
    public static function remove($id)
    {
        $user = User::find($id);
        $user->delete();
    }
    public static function updateName($id, $name)
    {
        User::where('id', '=', $id)->update(['name' => $name]);
    }
}