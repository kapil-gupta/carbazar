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
Route::group(['prefix' => $admin_routes_prefix], function () {
    
    Route::resource('vehicle', 'Admin\VehicleController');
    Route::get('dashboard', 'Admin\DashboardController@index');
    Route::post('vehicle/image-upload', ['as' => 'admin.vehicle.imageupload', 'uses' => 'Admin\PhotoController@save']);
    Route::get('/image/{size}/{file}','Admin\PhotoController@getImage');
    
});
Route::get('vehicle/images/{id}/{type}',['as' => 'vehicle.images', 'uses' => 'Admin\PhotoController@getImage']);
Route::delete('image/{id}',['as' => 'image.delete', 'uses' => 'Admin\PhotoController@delete']);
