<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use App\managerTeam;
use App\salary;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    private $user = "";
    protected $redirectTo = '/employee';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/[0-9]{10}/',
            'role' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'salary' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'password' => 'required|string|min:8|confirmed|max:255',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['isadmin'])) {
                // $user =  User::create([
                //     'name' => $data['name'],
                //     'phone' => $data['phone'],
                //     'role' => 'Admin',
                //     'email' => $data['email'],
                //     'admin' => 1,
                //     'password' => bcrypt($data['password']),
                // ]);
                $user = User::insert($data, true);
            } else {
                // $user =  User::create([
                //     'name' => $data['name'],
                //     'phone' => $data['phone'],
                //     'role' => $data['role'],
                //     'email' => $data['email'],
                //     'password' => bcrypt($data['password']),
                // ]);
                $user = User::insert($data, false);
            }

            $salary = new salary();
            $salary->salary = $data['salary'];
            $user->salary()->save($salary);
        } catch (\Exception $e) {
            DB::rollback();
            return view('error.show');
        }
        DB::commit();
        return $user;
    }
}
