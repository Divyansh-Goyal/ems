<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class salary extends Model
{
    public static function getAll()
    {
        $salary = salary::get();
        return $salary;
    }
    public static function getByUserId($id)
    {
        $salary = salary::where('user_id', '=', $id)->get();
        return $salary;
    }
    public static function salaryUpdate($id, $salary)
    {
        salary::where('user_id', '=', $id)
            ->update(['salary' => $salary]);
    }
}