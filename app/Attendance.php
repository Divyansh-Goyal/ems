<?php

namespace App;

use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    protected $PresentApproved = 'Approved';
    protected $PresentRejected = 'Rejected';
    protected $PresentPending = 'Pending';
    protected  $pagination = 5;
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * getById
     *
     * @param  mixed $id
     * @return void
     */
    public static function getById($id)
    {
        if (empty($id)) {
            return null;
        }
        return  Attendance::find($id);
    }



    /**
     * attendanceRequest
     *
     * @param  mixed $id
     * @param  mixed $x
     * @return void
     */
    public static function attendanceRequest(int $id, int $isPresent)
    {
        if (empty($id)) {
            return null;
        }
        $attendance = Attendance::find($id);
        if ($isPresent) {
            $attendance->request = $attendance->PresentApproved;;
        }
        $attendance->request = $attendance->PresentRejected;
        $attendance->attendance = $isPresent;
        return $attendance->update();
    }


    /**
     * PendingRequest
     *
     * @return void
     */
    public static function PendingRequest()
    {

        return  Attendance::where('request', 'Pending')
            ->get();
    }


    /**
     * requestCount
     *
     * @return void
     */
    public static function requestCount()
    {
        return (Attendance::select(DB::raw('SUM(if(`request`="Pending",1,0)) as Request'))
            ->get());
    }


    /**
     * getAttendanceUpdate
     *
     * @return void
     */
    public static function getAttendanceUpdate()
    {
        return Attendance::select(DB::raw('user_id, SUM(if(`Attendance`=1,1,0)) as Present, SUM(if(`Attendance`=1,0,1)) as Absent, SUM(if(`request`="Pending",1,0)) as Request'))
            ->groupBy('user_id')
            ->paginate(5);
    }

    /**
     * getAttendancebetween
     *
     * @param  mixed $from
     * @param  mixed $to
     * @return void
     */
    public static function getAttendancebetween($from, $to)
    {
        if (empty($from) || empty($to)) {
            return null;
        }
        return Attendance::select(DB::raw('user_id, SUM(if(`Attendance`=1,1,0)) as Present, SUM(if(`Attendance`=1,0,1)) as Absent, SUM(if(`request`="Pending",1,0)) as Request'))
            ->whereBetween('created_at', [$from, $to])
            ->groupBy('user_id')
            ->paginate(5);
    }


    /**
     * total
     *
     * @param  mixed $id
     * @return void
     */
    public static function total($id)
    {
        if (empty($id)) {
            return null;
        }
        return  Attendance::select('created_at')
            ->where('user_id', $id)
            ->where('created_at', '>=', date('Y-m-d') . ' 00:00:00')
            ->count();
    }

    /**
     * addRequest
     *
     * @param  mixed $id
     * @param  mixed $shift_time
     * @return void
     */
    public static function addRequest($id, $shift_time)
    {
        if (empty($id) || empty($shift_time)) {
            return null;
        }
        $attendance = new Attendance();
        $attendance->user_id = $id;
        $attendance->request = $attendance->PresentPending;
        $attendance->shift_time = $shift_time;
        $attendance->Attendance = 0;
        $attendance->save();
    }
}