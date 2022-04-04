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
            $users = User::get();
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.showEmployeeList', compact('users'));
    }


    public function getsalary()
    {
        try {
            $users = User::get();
            if (!$users) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.salaryDetail', compact('users'));
    }
    public function getAttendace()
    {
        try {
            $user_att = Attendance::select(DB::raw('user_id, SUM(if(`Attendance`=1,1,0)) as Present, SUM(if(`Attendance`=1,0,1)) as Absent, SUM(if(`request`="Pending",1,0)) as Request'))
                ->groupBy('user_id')
                ->paginate(5);
            if (!$user_att) {
                throw new ModelNotFoundException("No User");
            }
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return view('admin.attendanceDetail', compact('user_att'));
    }

    public function getPendingRequest()
    {
        try {
            $user_att = Attendance::where('request', 'Pending')->get();
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
            $user = User::findOrFail($id);
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
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->role = $request->input('role');
            $user->save();
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return redirect('/employees');
    }

    public function requestApproved($id)
    {
        try {
            Attendance::where('id', '=', $id)->update([
                'request' => 'Approved',
                'attendance' => 1
            ]);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Request Approved');
    }
    public function requestRejected($id)
    {
        try {
            Attendance::where('id', '=', $id)->update([
                'request' => 'Rejected',
                'attendance' => 0
            ]);
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
            $user = User::findOrFail($id);
            User::where('id', '=', $id)->update(['name' => request()->name]);
            salary::where('user_id', '=', $id)->update(['salary' => request()->salary]);
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
            User::where('id', '=', $id)->update([
                'name' => request()->name,
                'email' => request()->email,
                'phone' => request()->phone
            ]);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return redirect()->back();
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
                User::where('email', Auth::user()->email)
                    ->update(['password' => Hash::make($request->password)]);
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
            User::findOrFail($id)->delete();
            managerTeam::where('employee_id', $id)->delete();
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return Redirect()->back();
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