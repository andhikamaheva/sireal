<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group([ 'middleware' => 'guest' ], function () {
    Route::get('login', 'LoginController@index');
    Route::post('login/auth', 'LoginController@auth');
});


Route::group([
    'middleware' => 'auth',
    'prefix'     => 'dashboard',
], function () {

    //Dashboard
    Route::resource('/', 'Dashboard\DashboardController', [ 'names' => [ 'index' => 'dashboard' ] ]);
    //Semesters
    Route::resource('semesters', 'Dashboard\SemesterController', [
        'names' => [
            'index'   => 'semesters.index',
            'create'  => 'semesters.create',
            'destroy' => 'semesters.destroy',
            'store'   => 'semesters.store',
            'edit'    => 'semesters.edit',
            'update'  => 'semesters.update',
        ],
    ]);
    //Semesters
    Route::resource('batches', 'Dashboard\BatchController', [
        'names' => [
            'index'   => 'batches.index',
            'create'  => 'batches.create',
            'destroy' => 'batches.destroy',
            'store'   => 'batches.store',
            'edit'    => 'batches.edit',
            'update'  => 'batches.update',
        ],
    ]);
    //Students
    Route::resource('students', 'Dashboard\StudentController', [
        'names' => [
            'index'   => 'students.index',
            'create'  => 'students.create',
            'destroy' => 'students.destroy',
            'store'   => 'students.store',
            'edit'    => 'students.edit',
            'update'  => 'students.update',
        ],
    ]);

    //Subjects
    Route::resource('subjects', 'Dashboard\SubjectController', [
        'names' => [
            'index'   => 'subjects.index',
            'create'  => 'subjects.create',
            'destroy' => 'subjects.destroy',
            'store'   => 'subjects.store',
            'edit'    => 'subjects.edit',
            'update'  => 'subjects.update',
        ],
    ]);

    //Users
    Route::resource('users', 'Dashboard\UserController', [
        'names' => [
            'index'   => 'users.index',
            'create'  => 'users.create',
            'destroy' => 'users.destroy',
            'store'   => 'users.store',
            'edit'    => 'users.edit',
            'update'  => 'users.update',
        ],
    ]);

    //Roles
    Route::resource('roles', 'Dashboard\RoleController', [
        'names' => [
            'index'   => 'roles.index',
            'create'  => 'roles.create',
            'destroy' => 'roles.destroy',
            'store'   => 'roles.store',
            'edit'    => 'roles.edit',
            'update'  => 'roles.update',
        ],
    ]);


    Route::resource('settings', 'Dashboard\SettingController', [ 'names' => [ 'index' => 'settings.index' ] ]);

    Route::get('logout', 'LoginController@logout');

});
