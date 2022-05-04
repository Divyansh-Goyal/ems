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
     */
    public static function insert($data, $isAdmin)
    {
        if (empty($data)) {
            return null;
        }
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


    /**
     * getAll
     *
     */
    public static function getAll()
    {
        return User::get();
    }
    public static function getById($id)
    {
        return User::find($id);
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @param  mixed $data
     */
    public static function edit($id, array $data)
    {
        if (empty($data) || empty($id)) {
            return null;
        }
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
        return $user->update();
    }


    /**
     * remove
     *
     * @param  mixed $id
     * @return bool
     */
    public static function remove($id)
    {
        if (empty($id)) {
            return false;
        }
        $user = User::find($id);
        return $user->delete();
    }

    /**
     * total
     *
     * @param  mixed $id
     * @return int
     */
    public static function total($id)
    {
        if (empty($id)) {
            return 0;
        }
        return User::where('id', $id)
            ->where('role', 'Employee')
            ->count();;
    }


    /**
     * updatePassword
     *
     * @param  mixed $password
     * @return bool
     */
    public static function updatePassword($password)
    {
        if (empty($password)) {
            return false;
        }
        return user::where('email', Auth::user()->email)
            ->update(['password' => Hash::make($password)]);
    }

    /**
     * totalCount
     *
     * @param  mixed $type
     * @return int
     */
    public static function totalCount($type)
    {
        if (empty($type)) {
            return 0;
        }
        return (User::where("role", "=", $type)->count());
    }
}