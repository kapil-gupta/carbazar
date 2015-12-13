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
$admin_routes_prefix = config('app.backend_uri');
// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


Route::group(['prefix' => $admin_routes_prefix], function () {

    Route::get('vehicle-list', ['as' => 'vehicle.list', 'uses' => 'Admin\VehicleController@getList']);
    Route::resource('vehicle', 'Admin\VehicleController');
    Route::get('dashboard',['as' => 'admin.dashboard' , 'uses' =>'Admin\DashboardController@index']);
    Route::post('vehicle/image-upload', ['as' => 'admin.vehicle.imageupload', 'uses' => 'Admin\PhotoController@save']);
    Route::get('/image/{size}/{file}', 'Admin\PhotoController@getImage');
});
Route::get('vehicle/images/{id}/{type}', ['as' => 'vehicle.images', 'uses' => 'Admin\PhotoController@getImage']);
Route::delete('image/{id}', ['as' => 'image.delete', 'uses' => 'Admin\PhotoController@delete']);
