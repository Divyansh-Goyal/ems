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
    /**
     * insert
     *
     * @param  mixed $data
     * @param  mixed $isAdmin
     * @return void
     */
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
        //return $user;
    }


    /**
     * getAll
     *
     * @return void
     */
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

    /**
     * edit
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
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


    /**
     * remove
     *
     * @param  mixed $id
     * @return void
     */
    public static function remove($id)
    {
        $user = User::find($id);
        $user->delete();
    }

    /**
     * total
     *
     * @param  mixed $id
     * @return void
     */
    public static function total($id)
    {
        $count = User::where('id', $id)
            ->where('role', 'Employee')
            ->count();
        return $count;
    }


    /**
     * updatePassword
     *
     * @param  mixed $password
     * @return void
     */
    public static function updatePassword($password)
    {
        user::where('email', Auth::user()->email)
            ->update(['password' => Hash::make($password)]);
    }

    /**
     * totalCount
     *
     * @param  mixed $type
     * @return void
     */
    public static function totalCount($type)
    {
        return (User::where("role", "=", $type)->count());
    }
}