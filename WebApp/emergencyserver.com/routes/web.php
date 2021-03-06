<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/welcome', function () {
    return view('welcome');
});
Route::get('/abc', function () {
   	$people=["abc","pqr","xyz"];   	
    return view("test.abc",compact('people'));
});

Route::get('/abcontroller',"TestController@abc");

/*
-----------------------------------------------------------------
*/
Route::get('/home', function () {
    return view("im.Home");
});
Route::get('/about', function () {
    return view("im.About");
});

/*
------------------------------[ControlPanel]-------------------------------------
*/
Route::get('/','ControlPanel\ControlPanelController@viewEmergency');
Route::get('/controlpanel/view','ControlPanel\ControlPanelController@viewEmergency');
Route::get('/callEmergencyService','ControlPanel\ControlPanelController@emergencyCallPost');
Route::post('/callEmergencyServicePost','ControlPanel\ControlPanelController@emergencyCallPost');
Route::get('/sendmail','ControlPanel\ControlPanelController@testMail');
Route::get('/map/{id}','ControlPanel\ControlPanelController@map');
Route::get('/analyse','ControlPanel\ControlPanelController@analyse');
Route::get('/analyse/accidentstatus/{year?}','ControlPanel\ControlPanelController@getAccidentStatus');

Route::get('/analyse/accidentmonthlystatus/{year?}','ControlPanel\ControlPanelController@getAccidentMonthly');

