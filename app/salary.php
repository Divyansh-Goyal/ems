<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salary extends Model
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
        $salary = salary::get();
        return $salary;
    }


    /**
     * getByUserId
     *
     * @param  mixed $id
     */
    public static function getByUserId($id)
    {
        $salary = salary::where('user_id', '=', $id)->get();
        return $salary;
    }


    /**
     * salaryUpdate
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return void
     */
    public static function salaryUpdate($id, $data)
    {
        // salary::where('user_id', '=', $id)
        //     ->update(['salary' => $salary]);

        $salary = Salary::where('user_id', '=', $id)->first();
        // $user->name = $name;
        // $user->email = $email;
        // $user->phone = $phone;
        // $user->role = $role;
        // $user->update();
        if (empty($salary)) {
            return null;
        }
        foreach ($data as $attr => $value) {
            // TODO: Validate if the provided $attr is a property that can be set in the Object or not.      
            if (in_array($attr, $salary->fillable)) {
                $salary->{$attr} = $value;
            }
        }
        $salary->update();
    }
}