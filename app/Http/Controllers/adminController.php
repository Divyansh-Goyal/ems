<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Http\Requests\EditEmployeeValidation;
use App\Http\Requests\EditProfileValidation;
use App\Http\Requests\EditSalaryValidation;
use App\Http\Requests\UpdatePasswordValidation;
use App\ManagerTeam;
use App\Salary;
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
    protected $Present = 1;
    protected $Absent = 0;

    public function showAdd()
    {
        return view('admin.addEmployee');
    }

    public function showlist()
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

    public function showsalary()
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

    public function showAttendace(Request $request)
    {


        $from = $request->input('from', "");
        $to = $request->input('to', "");
        try {

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

    public function showPendingRequest()
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

    public function showEdit($id)
    {

        if (empty($id)) {
            return redirect()->back();
        }
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

    public function showProfile()
    {
        return view('admin.profile');
    }

    public function showPassword()
    {
        return view('admin.updatePassword');
    }

    public function edit(EditEmployeeValidation $request, $id)
    {
        //For Future Reference
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|regex:/[0-9]{10}/',
        //     'role' => 'required|string|max:50',
        //     'email' => 'required|string|email|max:255',
        // ]);
        if (empty($id)) {
            return redirect()->back();
        }
        try {
            //For Future Reference
            // $name = $request->input('name');
            // $email = $request->input('email');
            // $phone = $request->input('phone');
            // $role = $request->input('role');
            $userEdit = User::edit($id, $request->all());
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Updated');
    }

    public function requestApproved($id)
    {
        if (empty($id)) {
            return redirect()->back();
        }
        try {

            $AttendanceApproved = Attendance::attendanceRequest($id, $this->Present);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Request Approved');
    }
    public function requestRejected($id)
    {
        if (empty($id)) {
            return redirect()->back();
        }
        try {

            $AttendanceRejected = Attendance::attendanceRequest($id, $this->Absent);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Request Rejected');
    }
    public function salaryedit(EditSalaryValidation $request, $id)
    {
        //For Future Reference
        // $this->validate($request, [
        //     'name' => 'required|max:255',
        //     'salary' => 'required',
        // ]);
        if (empty($id)) {
            return redirect()->back();
        }
        try {
            //For Future Reference
            // $salary =   $request->input('salary');
            // $name = $request->input('name');
            // User::updateName($id, $name);
            $userEdit = User::edit($id, $request->all());
            $salaryEdit = Salary::salaryUpdate($id, $request->all());
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return redirect()->back();
    }

    public function updateprofile(EditProfileValidation $request)
    {
        //For Future Reference
        // $this->validate($request, [
        //     'name' => 'required|string|max:255',
        //     'phone' => 'required|regex:/[0-9]{10}/',
        //     'email' => 'required|string|email|max:255',
        // ]);
        try {
            $id = Auth::user()->id;
            //For Future Reference
            // $name = $request->input('name');
            // $email = $request->input('email');
            // $phone = $request->input('phone');
            // $role = Auth::user()->role;
            // User::edit($id, $name, $email, $phone, $role);
            $userEdit = User::edit($id, $request->all());
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return back()->with('message', 'Updated');
    }

    public function updatePassword(UpdatePasswordValidation $request)
    {
        //For Future Reference
        // $this->validate($request, [
        //     'current_password' => 'required|string|min:8',
        //     'password' => 'required|string|min:8|confirmed',
        //     'password_confirmation' => 'required',
        // ]);
        try {
            if (Hash::check($request->get('current_password'), Auth::user()->password)) {
                $userPasswordUpdate = User::updatePassword($request->password);
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
        if (empty($id)) {
            return redirect()->back();
        }
        try {
            $memberDelete = ManagerTeam::deleteByEmpID($id);
            $userDelete = User::remove($id);
        } catch (\Exception $exception) {
            return view('error.show');
        }
        return Redirect('/employees');
    }
    //For Future Reference
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


    //Sample API PART with Queries at same place 
    public function listEmployees(Request $request)
    {
        $page = 1;
        if ($request->page) {
            $page = $request->page;
        }
        if ($request->id) {
            $list = User::with('salary')
                ->find($request->id);
        } elseif ($request->joining) {
            $list = User::with('salary')
                ->where('created_at', '>',  date('Y-m-d', strtotime($request->joining)))
                ->get();
        } elseif ($request->name) {
            $list = User::with('salary')
                ->where('name', 'like', '%' . $request->name . '%')
                ->get();
        } elseif ($request->from && $request->to) {
            $list = DB::table('users')
                ->join('salaries', 'users.id', '=', 'salaries.user_id')
                ->whereBetween('salaries.salary', [floatval($request->from), floatval($request->to)])
                ->get();
            //$user_ids = Salary::select('user_id')->whereBetween('salary', [floatval($request->from), floatval($request->to)])->get();

            //$list = User::with('salary')->whereBetween(salary::select('salary')->where('user_id', '')->get(), [floatval($request->from), floatval($request->to)])->get();
        } else {
            // $list = User::get();
            $list = User::with('salary')->offset(($page - 1) * 10)->limit(10)
                ->get();
        }
        return response()->json([
            'msg' => 'List Fetched',
            'list' => $list
        ], 200);
    }
}