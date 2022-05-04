<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'salary',
    ];


    /**
     * getAll
     *
     * @return void
     */
    public static function getAll()
    {
        return salary::get();
    }


    /**
     * getByUserId
     *
     * @param  mixed $id
     */
    public static function getByUserId($id)
    {
        if (empty($id)) {
            return null;
        }
        return salary::where('user_id', '=', $id)->get();
    }


    /**
     * salaryUpdate
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return bool
     */
    public static function salaryUpdate($id, $data)
    {
        if (empty($id) || empty($data)) {
            return false;
        }


        $salary = Salary::where('user_id', '=', $id)->first();
        //For Future Reference
        // $user->name = $name;
        // $user->email = $email;
        // $user->phone = $phone;
        // $user->role = $role;
        // $user->update();
        if (empty($salary)) {
            return false;
        }
        foreach ($data as $attr => $value) {
            // TODO: Validate if the provided $attr is a property that can be set in the Object or not.      
            if (in_array($attr, $salary->fillable)) {
                $salary->{$attr} = $value;
            }
        }
        return $salary->update();
    }
}