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

        Route::patch('/update/password', 'adminController@updatePassword');

        //Only for Admin
        Route::group(['middleware' => 'isadmin'], function () {
            Route::get('/employee', 'adminController@showAdd');
            Route::get('/employees', 'adminController@showlist');


            Route::get('/empSalary', 'adminController@showsalary');
            Route::patch('/salary/edit/{id}', 'adminController@salaryedit')->where('id', '[0-9]+');

            Route::get('/adminprofile', 'adminController@showProfile');
            Route::patch('/update', 'adminController@updateprofile');

            Route::get('/passwordChange', 'adminController@showPassword');


            Route::get('/empAttendance', 'adminController@showAttendace');
            Route::get('/requestPending', 'adminController@showPendingRequest');
            Route::get('/requestPending/rejected/{id}', 'adminController@requestRejected')->where('id', '[0-9]+');
            Route::get('/requestPending/approved/{id}', 'adminController@requestApproved')->where('id', '[0-9]+');

            Route::get('/employee/edit/{id}', 'adminController@showedit')->where('id', '[0-9]+');
            Route::put('/employee/edit/{id}', 'adminController@edit')->where('id', '[0-9]+');

            Route::get('/employee/delete/{id}', 'adminController@delete')->where('id', '[0-9]+');

            //Route::match(['GET', 'PUT'], '/employee/edit/{id}', 'adminController@getedit')->where('id', '[0-9]+');
            //Route::get('/employee/search/{word}', 'adminController@search')->where('name', '[A-Za-z]+');
        });

        //Only for User
        Route::group(['middleware' => 'isuser'], function () {
            Route::get('/salary', 'employeeController@showSalary');

            Route::get('/attendance', 'employeeController@showAttendance');
            Route::post('/attendance/update', 'employeeController@attendanceRequest');

            Route::get('/getTeamList', 'employeeController@showTeamList');
            Route::post('/teamMember/add', 'employeeController@addMember');

            Route::get('/profile', 'employeeController@showProfile');
            Route::patch('/profile/update', 'employeeController@updateprofile');

            Route::get('/password', 'employeeController@showPassword');
        });
    });
});
Route::get('/{any}', function () {
    return view('welcome');
});