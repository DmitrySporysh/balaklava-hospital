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
//----------Emergency-----------------
Route::get('emergency/patients', 'EmergencyController@getReceivedPatients'); //

Route::post('emergency/addNewInpatient', 'EmergencyController@addNewInpatient');

Route::get('emergency', function () {
    return view('layouts.emergency_room');
});

//---------Doctor-------------------

Route::get('doctor/inpatients', 'DoctorController@getDoctorInpatients'); //doctor#/patients

Route::get('doctor/inpatient/{id}', 'DoctorController@getInpatientInfo');

Route::get('doctor/getInpatientAllInfo/{id}', 'DoctorController@getInpatientAllInfo');

Route::get('doctor/inpatient/{id}/inspection_protocol', 'DoctorController@getInpatientInspectionProtocol');

Route::get('doctor/inpatient/{id}/medical_appointments', 'DoctorController@getInpatientMedicalAppointments');

Route::get('doctor/inpatient/{id}/inspections', 'DoctorController@getInpatientInspections');

Route::get('doctor/inpatient/{id}/analyzes', 'DoctorController@getInpatientAnalyzes');

Route::get('doctor/inpatient/{id}/procedures', 'DoctorController@getInpatientProcedures');

Route::get('doctor/inpatient/{id}/operations', 'DoctorController@getInpatientOperations');

Route::get('doctor/emergency', 'DoctorController@getAwaitingPrimaryInspectionPatients'); //doctor#/emergency

Route::get('doctor/received_patient/{id}', 'DoctorController@getReceivedPatient'); //doctor#/

Route::get('doctor/archive', 'DoctorController@getPatientsArchive'); //doctor#/

Route::post('doctor/addNewInspectionProtocol', 'DoctorController@addNewInspectionProtocol');

Route::post('doctor/inpatient/addAnalysis', 'DoctorController@addNewInpatientAnalysis');

Route::post('doctor/inpatient/addProcedure', 'DoctorController@addNewInpatientProcedure');

Route::post('doctor/inpatient/addInspection', 'DoctorController@addNewInpatientInspection');

Route::post('doctor/inpatient/addOperation', 'DoctorController@addNewInpatientOperation');

Route::post('doctor/inpatient/addMedicalAppointment', 'DoctorController@addNewInpatientMedicalAppointment');

Route::get('doctor', function () {
    return view('layouts.doctor_room');
});

//---------DepartmentChief-------------------
Route::get('department_chief/inpatients', 'DepartmentChiefController@getDepartmentInpatients');


//----------Nurse-------------------------------
Route::get('nurse/departments', 'NurseController@getDepartments'); //+

Route::get('nurse/department/{id}/chambers', 'NurseController@getDepartmentChambers');//+

Route::get('nurse/chamber/{id}', 'NurseController@getChamberWithPatients');//+

Route::get('nurse/inpatient/{id}', 'NurseController@getInpatientInfo');//+ TODO еще согласовать поля

Route::get('nurse/inpatient/{id}/inspection_protocol', 'NurseController@getInpatientInspectionProtocol');

Route::get('nurse/inpatient/{id}/medical_appointments', 'NurseController@getInpatientMedicalAppointments');

Route::get('nurse/inpatient/{id}/inspections', 'NurseController@getInpatientInspections');

Route::get('nurse/inpatient/{id}/analyzes', 'NurseController@getInpatientAnalyzes');

Route::get('nurse/inpatient/{id}/procedures', 'NurseController@getInpatientProcedures');

Route::get('nurse/inpatient/{id}/operations', 'NurseController@getInpatientOperations');

//no important ---------------------------------------
Route::get('nurse/chambers', 'NurseController@getNotEmptyChambers');

Route::get('nurse/allChambers', 'NurseController@getChambers');

Route::get('nurse/testFunc', 'NurseController@testFunc');
//----------

Route::get('/', function () {
    return view('welcome');
});
