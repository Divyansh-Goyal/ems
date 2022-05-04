<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ManagerTeam extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * deleteByEmpID
     *
     * @param  mixed $id
     * @return void
     */
    public static function deleteByEmpID($id)
    {
        if (empty($id)) {
            return null;
        }
        managerTeam::where('employee_id', $id)
            ->delete();
    }

    /**
     * getEmpID
     *
     * @param  mixed $id
     */
    public static function getEmpID($id)
    {
        if (empty($id)) {
            return null;
        }
        return  managerTeam::select('employee_id')
            ->where('user_id', $id)->get();;
    }

    /**
     * addTeamMember
     *
     * @param  mixed $id
     * @param  mixed $emp_id
     * @return void
     */
    public static function addTeamMember($id, $emp_id)
    {
        if (empty($id) || empty($emp_id)) {
            return null;
        }
        $managerTeam = new managerTeam();
        $managerTeam->employee_id = $emp_id;
        $managerTeam->user_id = $id;
        $managerTeam->save();
    }

    public static function alreadyReady($employee_id)
    {
        if (empty($employee_id)) {
            return false;
        }
        return ManagerTeam::where('employee_id', $employee_id)->count();
    }

    public static function ManagerName()
    {
        return (managerTeam::where('employee_id', Auth::user()->id)
            ->first());
    }
}