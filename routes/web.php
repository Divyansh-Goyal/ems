<?php

use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;



Route::get('/', function () {
    return view('welcome');
});


Route::get('home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'usersession'], function () {

    Route::group(['middleware' => 'auth'], function () {

        Route::patch('/update/password', 'AdminController@updatePassword');

        //Only for Admin
        Route::group(['middleware' => 'isadmin'], function () {
            Route::get('/employee', 'AdminController@showAdd');
            Route::get('/employees', 'AdminController@showlist');


            Route::get('/employees-salary', 'AdminController@showsalary');
            Route::patch('/salary/edit/{id}', 'AdminController@salaryedit')->where('id', '[0-9]+');

            Route::get('/adminprofile', 'AdminController@showProfile');
            Route::patch('/update', 'AdminController@updateprofile');

            Route::get('/passwordChange', 'AdminController@showPassword');


            Route::get('/employees-attendance', 'AdminController@showAttendace');
            Route::get('/requestPending', 'AdminController@showPendingRequest');
            Route::get('/requestPending/rejected/{id}', 'AdminController@requestRejected')->where('id', '[0-9]+');
            Route::get('/requestPending/approved/{id}', 'AdminController@requestApproved')->where('id', '[0-9]+');

            Route::get('/employee/edit/{id}', 'AdminController@showedit')->where('id', '[0-9]+');
            Route::put('/employee/edit/{id}', 'AdminController@edit')->where('id', '[0-9]+');

            Route::get('/employee/delete/{id}', 'AdminController@delete')->where('id', '[0-9]+');

            //Route::match(['GET', 'PUT'], '/employee/edit/{id}', 'adminController@getedit')->where('id', '[0-9]+');
            //Route::get('/employee/search/{word}', 'adminController@search')->where('name', '[A-Za-z]+');
        });

        //Only for User
        Route::group(['middleware' => 'isuser'], function () {
            Route::get('/salary', 'EmployeeController@showSalary');

            Route::get('/attendance', 'EmployeeController@showAttendance');
            Route::post('/attendance/update', 'EmployeeController@attendanceRequest');

            Route::get('/getTeamList', 'EmployeeController@showTeamList');
            Route::post('/teamMember/add', 'EmployeeController@addMember');

            Route::get('/profile', 'EmployeeController@showProfile');
            Route::patch('/profile/update', 'EmployeeController@updateprofile');

            Route::get('/password', 'EmployeeController@showPassword');
        });
    });
});
Route::get('/{any}', function () {
    return view('welcome');
});