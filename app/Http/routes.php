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

Route::group([ 'middleware' => 'guest',
               'prefix'     => 'pendaftaran'
], function () {
    Route::resource('/', 'RegistrationController', [
        'names' => [
            'index'   => 'registration.index',
            'create'  => 'registration.create',
            'destroy' => 'registration.destroy',
            'store'   => 'registration.store',
            'edit'    => 'registration.edit',
            'update'  => 'registration.update',
        ],
    ]);
});

Route::group([
    'middleware' => 'auth',
    'prefix'     => 'dashboard',
], function () {

    //Dashboard
    Route::resource('/', 'Dashboard\DashboardController', [ 'names' => [ 'index' => 'dashboard' ] ]);
    //Semesters

    //Scores
    Route::group([ 'prefix' => 'scores' ], function () {
        Route::resource('administrations', 'Dashboard\AdministrationController', [
            'names' => [
                'index'   => 'administrations.index',
                'create'  => 'administrations.create',
                'destroy' => 'administrations.destroy',
                'store'   => 'administrations.store',
                'edit'    => 'administrations.edit',
                'update'  => 'administrations.update',
            ]
        ]);

        Route::resource('tpas', 'Dashboard\TpaController', [
            'names' => [
                'index'   => 'tpas.index',
                'create'  => 'tpas.create',
                'destroy' => 'tpas.destroy',
                'store'   => 'tpas.store',
                'edit'    => 'tpas.edit',
                'update'  => 'tpas.update',
            ],
        ]);


        Route::resource('auditions', 'Dashboard\AuditionController', [
            'names' => [
                'index'   => 'auditions.index',
                'create'  => 'auditions.create',
                'destroy' => 'auditions.destroy',
                'store'   => 'auditions.store',
                'edit'    => 'auditions.edit',
                'update'  => 'auditions.update',
            ],
        ]);

        /*  Route::get('weighting', [ 'as'   => 'weight.index',
                                    'uses' => 'DashboardControllerWeightController'

          ]);*/

        Route::resource('interviews', 'Dashboard\InterviewController', [
            'names' => [
                'index'   => 'interviews.index',
                'create'  => 'interviews.create',
                'destroy' => 'interviews.destroy',
                'store'   => 'interviews.store',
                'edit'    => 'interviews.edit',
                'update'  => 'interviews.update',
            ],
        ]);

        Route::resource('weights', 'Dashboard\WeightController', [
            'names' => [
                'index'   => 'weights.index',
                'create'  => 'weights.create',
                'destroy' => 'weights.destroy',
                'store'   => 'weights.store',
                'edit'    => 'weights.edit',
                'update'  => 'weights.update',
            ],
        ]);
    });

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

    Route::resource('reports', 'Dashboard\ReportController', [
        'names' => [
            'index'   => 'reports.index',
            'create'  => 'reports.create',
            'destroy' => 'reports.destroy',
            'store'   => 'reports.store',
            'edit'    => 'reports.edit',
            'update'  => 'reports.update',
        ],
    ]);

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
