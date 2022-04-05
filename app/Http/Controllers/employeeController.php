<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\managerTeam;
use App\User;
use Attribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class employeeController extends Controller
{
    public function getsalary()
    {
        return view('user.salaryDetail');
    }
    public function getattendance()
    {
        return view('user.attendance');
    }
    public function getProfile()
    {
        return view('user.profile');
    }
    public function getpassword()
    {
        return view('user.passwordUpdate');
    }
    public function getTeamList()
    {
        try {
            if (Auth::user()->role == 'Manager') {
                $id = Auth::user()->id;
                $team_ids = managerTeam::getEmpId($id);
                $id = [];
                foreach ($team_ids as $teamId) {
                    array_push($id, $teamId->employee_id);
                }
                $users = User::whereIn("id", $id)->get();
            } else {
                throw new ModelNotFoundException("No Such Route");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('user.teamList', compact('users'));
    }
    public function updateprofile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{10}/',
            'email' => 'required|string|email|max:255',
        ]);
        try {
            $id = Auth::user()->id;
            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = Auth::user()->role;
            User::edit($id, $name, $email, $phone, $role);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return redirect()->back();
    }

    public function addMember(Request $request)
    {
        $this->validate($request, [
            'emp_id' => 'required|numeric',
        ]);
        try {
            $count = User::where('id', $request->emp_id)
                ->where('role', 'Employee')
                ->count();
            if ($count > 0) {
                $user = Auth::user();
                $managerTeam = new managerTeam();
                $managerTeam->employee_id = $request->emp_id;
                $user->managerTeam()->save($managerTeam);
            } else {
                return back()->with('msg', 'Employee Does Not Exist');
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('msg', 'Employee Added in your Team');
    }
    public function attendanceRequest(Request $request)
    {
        try {
            $user = Auth::user();
            $user_att = Attendance::total($user->id);
            if ($user_att > 0) {
                return back()->with('msg', 'Attendance Request Alreaday Submitted');
            } else {
                $shift_time = $request->out - $request->in;
                Attendance::addRequest($user->id, $shift_time);
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('msg', 'Attendance Request Submitted');
    }
}