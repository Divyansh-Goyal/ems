<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class managerTeam extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function deleteByEmpID($id)
    {
        managerTeam::where('employee_id', $id)
            ->delete();
    }
    public static function getEmpID($id)
    {
        $emp_id = managerTeam::select('employee_id')
            ->where('user_id', $id)->get();
        return $emp_id;
    }
}