<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\managerTeam;
use App\salary;
use App\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;

class adminController extends Controller
{
    public function getAdd()
    {
        return view('admin.addEmployee');
    }
    public function index()
    {
        try {

            $users = User::getAll();
            if (!$users) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.showEmployeeList', compact('users'));
    }


    public function getsalary()
    {
        try {
            $users = User::getAll();
            if (!$users) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.salaryDetail', compact('users'));
    }
    public function getAttendace(Request $request)
    {
        try {
            $from = $request['from'] ?? "";
            $to = $request['to'] ?? "";
            if ($from != "" && $to != "") {
                $user_att = Attendance::getAttendancebetween($from, $to);
            } else {
                $user_att = Attendance::getAttendanceUpdate();
            }
            if (!$user_att) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.attendanceDetail', compact('user_att', 'from', 'to'));
    }

    public function getPendingRequest()
    {
        try {
            $user_att = Attendance::PendingRequest();
            if (!$user_att) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.attendanceRequest', compact('user_att'));
    }
    public function getEdit($id)
    {
        try {
            $user = User::getById($id);
            if (!$user) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.editEmp', compact('user'));
    }

    public function getProfile()
    {
        return view('admin.profile');
    }
    public function getPassword()
    {
        return view('admin.updatePassword');
    }

    public function postedit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{10}/',
            'role' => 'required|string|max:50',
            'email' => 'required|string|email|max:255',
        ]);
        try {

            $name = $request->input('name');
            $email = $request->input('email');
            $phone = $request->input('phone');
            $role = $request->input('role');
            User::edit($id, $name, $email, $phone, $role);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Updated');
    }

    public function requestApproved($id)
    {
        try {
            Attendance::attendanceRequest($id, 1);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Request Approved');
    }
    public function requestRejected($id)
    {
        try {
            Attendance::attendanceRequest($id, 0);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Request Rejected');
    }
    public function salaryedit(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'salary' => 'required',
        ]);
        try {
            $salary =   $request->input('salary');
            $name = $request->input('name');
            User::updateName($id, $name);
            salary::salaryUpdate($id, $salary);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return redirect()->back();
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
        return back()->with('message', 'Updated');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
        ]);
        try {
            if (Hash::check($request->get('current_password'), Auth::user()->password)) {
                User::updatePassword($request->password);
            } else {
                return back()->with('msg', 'Current Password Do not Match');
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return redirect()->back()->with('message', 'Password Updated');
    }
    public function delete($id)
    {
        try {
            managerTeam::deleteByEmpID($id);
            user::remove($id);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return Redirect('/employees');
    }
    // public function search()
    // {
    //     if (!empty($_GET['words'])) {
    //         $words = $_GET['words'];
    //         $users = User::where('name', 'like', '%' . $words . '%')->get();
    //         return redirect()->route('home', compact($users));
    //     } else {
    //         return redirect()->back();
    //     }
    // }
}