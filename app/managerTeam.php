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
    public static function addTeamMember($id, $emp_id)
    {
        $managerTeam = new managerTeam();
        $managerTeam->employee_id = $emp_id;
        $managerTeam->user_id = $id;
        $managerTeam->save();
    }
}