<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    // public function insert()
    // {
    // }
    public static function insert($data, $isAdmin)
    {
        $user = new User();
        foreach ($data as $attr => $value) {
            // TODO: Validate if the provided $attr is a property that can be set in the Object or not.      
            if (in_array($attr, $user->fillable)) {
                $user->{$attr} = $value;
            }
        }
        $user->password = bcrypt($data['password']);
        if ($isAdmin) {
            $user->admin = 1;
            $user->role = 'admin';
        }
        $user->save();
        return $user;
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
    public static function edit($id, array $data)
    {
        $user = User::find($id);
        // $user->name = $name;
        // $user->email = $email;
        // $user->phone = $phone;
        // $user->role = $role;
        // $user->update();
        if (empty($user)) {
            return null;
        }
        foreach ($data as $attr => $value) {
            // TODO: Validate if the provided $attr is a property that can be set in the Object or not.      
            if (in_array($attr, $user->fillable)) {
                $user->{$attr} = $value;
            }
        }
        $user->update();
    }
    public static function remove($id)
    {
        $user = User::find($id);
        $user->delete();
    }
    public static function total($id)
    {
        $count = User::where('id', $id)
            ->where('role', 'Employee')
            ->count();
        return $count;
    }
    public static function updatePassword($password)
    {
        user::where('email', Auth::user()->email)
            ->update(['password' => Hash::make($password)]);
    }
    public static function totalCount($type)
    {
        return (User::where("role", "=", $type)->count());
    }
}