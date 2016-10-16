<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//----------Health worker-----------------
Route::get('receivedPatients', 'HealthWorkerController@getReceivedPatients');

Route::get('patient/{id}', 'HealthWorkerController@getPatient');


//----------Nurse-------------------------------
Route::get('nurse/departments', 'NurseController@getDepartments');

Route::get('nurse/department/{id}/chambers', 'NurseController@getDepartmentChambers');

Route::get('nurse/chamber/{id}', 'NurseController@getChamberWithPatients');

Route::get('nurse/patient/{id}', 'NurseController@getPatient');

Route::get('nurse/patient/{id}/dressings', 'NurseController@dressings');

Route::get('nurse/patient/{id}/inspections', 'NurseController@inspections');

Route::get('nurse/patient/{id}/operations', 'NurseController@operations');

Route::get('nurse/patient/{id}/surveys', 'NurseController@surveys');

Route::get('nurse/patient/{id}/treatments', 'NurseController@treatments');

//no important ---------------------------------------
Route::get('nurse/chambers', 'NurseController@getNotEmptyChambers');

Route::get('nurse/allChambers', 'NurseController@getChambers');

Route::get('nurse/testFunc', 'NurseController@testFunc');
//----------

Route::get('/', function () {
    return view('welcome');
});
