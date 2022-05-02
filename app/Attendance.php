<?php

namespace App;

use Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attendance extends Model
{
    protected static $presentApproved = 'Approved';
    protected static $PresentRejected = 'Rejected';
    protected static $PresentPending = 'Pending';
    protected static $pagination = 5;
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
     * @return bool
     */
    public static function attendanceRequest(int $id, int $isPresent)
    {
        if (empty($id)) {
            return false;
        }
        $attendance = Attendance::find($id);
        if ($isPresent) {
            $attendance->request = self::$presentApproved;
        }
        $attendance->request = self::$PresentRejected;
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

        return  Attendance::where('request', self::$PresentPending)
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
            ->paginate(self::$pagination);
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
            ->paginate(self::$pagination);
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
     * @return bool
     */
    public static function addRequest($id, $shift_time)
    {
        if (empty($id) || empty($shift_time)) {
            return false;
        }
        $attendance = new Attendance();
        $attendance->user_id = $id;
        $attendance->request = $attendance->PresentPending;
        $attendance->shift_time = $shift_time;
        $attendance->Attendance = 0;
        return $attendance->save();
    }
}