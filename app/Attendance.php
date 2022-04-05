<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getById($id)
    {
        $attendance = $this->find($id);
        return $attendance;
    }
    public function attendanceRequest(int $id, int $x)
    {
        $attendance = $this->getById($id);
        $attendance->request = 'Rejected';
        $attendance->attendance = $x;
        $attendance->update();
    }
    public function PendingRequest()
    {
        $user_att = $this->where('request', 'Pending')
            ->get();
        return $user_att;
    }
    public function getAttendanceUpdate()
    {
        $user_att = $this->select(DB::raw('user_id, SUM(if(`Attendance`=1,1,0)) as Present, SUM(if(`Attendance`=1,0,1)) as Absent, SUM(if(`request`="Pending",1,0)) as Request'))
            ->groupBy('user_id')
            ->paginate(5);
        return $user_att;
    }
    public function total($id)
    {
        $user_att = $this->select('created_at')
            ->where('user_id', $id)
            ->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')
            ->count();
        return $user_att;
    }
    public function addRequest($id, $shift_time)
    {
        $this->user_id = $id;
        $this->request = 'Pending';
        $this->shift_time = $shift_time;
        $this->Attendance = 0;
        $this->save();
        // $this->create([
        //     'user_id' => $id,
        //     'request' => 'Pending',
        //     'shift_time' => $shift_time,
        //     'Attendance' => 0,
        // ]);
    }
}