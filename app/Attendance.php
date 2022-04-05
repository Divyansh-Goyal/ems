<?php

namespace App;

use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public static function getById($id)
    {
        $attendance = Attendance::find($id);
        return $attendance;
    }
    public static function attendanceRequest(int $id, int $x)
    {
        $attendance = Attendance::find($id);
        $attendance->request = 'Rejected';
        $attendance->attendance = $x;
        $attendance->update();
    }
    public static function PendingRequest()
    {
        $user_att = Attendance::where('request', 'Pending')
            ->get();
        return $user_att;
    }
    public static function getAttendanceUpdate()
    {
        $user_att = Attendance::select(DB::raw('user_id, SUM(if(`Attendance`=1,1,0)) as Present, SUM(if(`Attendance`=1,0,1)) as Absent, SUM(if(`request`="Pending",1,0)) as Request'))
            ->groupBy('user_id')
            ->paginate(5);
        return $user_att;
    }
    public static function total($id)
    {
        $user_att = Attendance::select('created_at')
            ->where('user_id', $id)
            ->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')
            ->count();
        return $user_att;
    }
    public static function addRequest($id, $shift_time)
    {
        $attendance = new Attendance();
        $attendance->user_id = $id;
        $attendance->request = 'Pending';
        $attendance->shift_time = $shift_time;
        $attendance->Attendance = 0;
        $attendance->save();
    }
}