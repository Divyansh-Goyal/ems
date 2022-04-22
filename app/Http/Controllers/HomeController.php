<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\Jobs\SendNoti;
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
                    $array[0] = User::totalCount("Employee");
                    $array[1] = User::totalCount("Manager");
                    $array[2] = salary::sum('salary');
                    $array[3] = Attendance::requestCount();
                } catch (\Exception $exception) {
                    return view('error.show');
                }
                return view('admin.home', compact('array'));
            } else {
                try {
                    if (Auth::user()->role === 'Employee') {
                        $manager = managerTeam::ManagerName();
                        $user = Auth::user();
                        if (empty($manager)) {
                            SendNoti::dispatch($user);
                        }
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