<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\managerTeam;
use App\salary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::id()) {
            if (Auth::user()->admin) {
                try {
                    $array = [];
                    $array[0] = User::where("role", "=", "Employee")->count();
                    $array[1] = User::where("role", "=", "Manager")->count();
                    $array[2] = salary::sum('salary');
                    $array[3] = Attendance::select(DB::raw('SUM(if(`request`="Pending",1,0)) as Request'))
                        ->get();
                } catch (\Exception $exception) {
                    return view('error.show');
                }
                return view('admin.home', compact('array'));
            } else {
                try {
                    if (Auth::user()->role === 'Employee') {
                        $manager = managerTeam::where('employee_id', Auth::user()->id)
                            ->first();
                        return view('user.home', compact('manager'));
                    } else {
                        return view('user.home');
                    }
                } catch (\Exception $exception) {
                    return view('error.show');
                }
            }
        } else {
            return redirect()->back();
        }
    }
}