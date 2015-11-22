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

Route::get('/', function() {

    return view('admin.dashboard.index');
});
$admin_routes_prefix  = config('app.backend_uri');
Route::group(['prefix' => $admin_routes_prefix], function () {
    Route::resource('vehicle', 'Admin\VehicleController');
    Route::get('dashboard', 'Admin\DashboardController@index');
});
