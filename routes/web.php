<?php

use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;



Route::get('/', function () {
    return view('welcome');
});


Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::group(['middleware' => 'usersession'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::patch('/update/password', 'adminController@updatePassword');
        //Only for Admin
        Route::group(['middleware' => 'isadmin'], function () {
            Route::get('/addEmployee', 'adminController@getAdd');
            Route::get('/employees', 'adminController@index');
            Route::get('/empAttendance', 'adminController@getAttendace');
            Route::get('/empSalary', 'adminController@getsalary');
            Route::get('/adminprofile', 'adminController@getProfile');
            Route::get('/passwordChange', 'adminController@getPassword');
            Route::get('/requestPending', 'adminController@getPendingRequest');
            Route::get('/requestPending/rejected/{id}', 'adminController@requestRejected')->where('id', '[0-9]+');
            Route::get('/requestPending/approved/{id}', 'adminController@requestApproved')->where('id', '[0-9]+');
            Route::patch('/adminprofile/update', 'adminController@updateprofile');
            Route::get('/employee/edit/{id}', 'adminController@getedit')->where('id', '[0-9]+');
            Route::put('/employee/edit/{id}', 'adminController@postedit')->where('id', '[0-9]+');
            Route::patch('/salary/edit/{id}', 'adminController@salaryedit')->where('id', '[0-9]+');
            Route::get('/employee/delete/{id}', 'adminController@delete')->where('id', '[0-9]+');
            Route::get('/employee/search/{word}', 'adminController@search')->where('name', '[A-Za-z]+');
        });
        //Only for User
        Route::group(['middleware' => 'isuser'], function () {
            Route::get('/salary', 'employeeController@getsalary');
            Route::post('/attendance/update', 'employeeController@attendanceRequest');
            Route::get('/getTeamList', 'employeeController@getTeamList');
            Route::post('/teamMember/add', 'employeeController@addMember');
            Route::get('/attendance', 'employeeController@getattendance');
            Route::get('/profile', 'employeeController@getprofile');
            Route::get('/password', 'employeeController@getpassword');
            Route::patch('/profile/update', 'employeeController@updateprofile');
        });
    });
});
Route::get('/{any}', function () {
    return view('welcome');
});