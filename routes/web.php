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

//Auth-Register routes

Route::get('/register', 'RegistrationController@showRegistrationForm');

Route::post('/register', 'RegistrationController@register');

Route::get('/login', 'Auth\AuthController@showLoginForm');

Route::post('/login', 'Auth\AuthController@login');

Route::post('/logout', 'Auth\AuthController@logout');
/*

Route::get('/forgetpassword','EntryController@getForgetPasswordPage');

Route::get('/confirm/{token}','RegistrationController@confirm');

Route::post('/registerConfirmUser','RegistrationController@registerConfirmUser');


Route::post('/reset','Auth\PasswordController@forgetAccept@reset');

Route::get('/newPassword','Auth\PasswordController@forget');

Route::get('/reset/{token}','Auth\PasswordController@forgetAccept');

Route::post('/forget','Auth\PasswordController@resetForget');

Route::get('/profile','EntryController@profile');*/
//

//---------Doctor-------------------


Route::get('/doctor', 'DoctorController@getDoctorInpatients'); //doctor#/patients

Route::get('doctor', function () {
    return view('doctor');
});


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

//--------operations doctor-------------

Route::get('doctor/getAllNotReadyOperations', 'DoctorController@getAllNotReadyOperations');

//TODO
//-----------Medical nurse----------------
Route::get('medical_nurse/received_patients', 'MedicalNurseController@getReceivedPatients'); //

Route::post('medial_nurse/addNewInpatient', 'MedicalNurseController@addNewInpatient');

Route::get('nurse', function () {
    return view('nurse');
});

//-----------analyzes nurse--------------
Route::get('medical_nurse/getAllNotReadyAnalyzes', 'MedicalNurseController@getAllNotReadyAnalyzes');

Route::post('medial_nurse/addAnalysisResult', 'MedicalNurseController@addAnalysisResult');

//TODO
//---------DepartmentChief-------------------
Route::get('department_chief', 'DepartmentChiefController@getDepartmentInpatients');

Route::get('department_chief/inpatients', 'DepartmentChiefController@getDepartmentInpatients');

Route::get('department_chief/inpatient/{id}', 'DepartmentChiefController@getInpatientInfo');

Route::get('department_chief/doctors', 'DepartmentChiefController@getDepartmentDoctors');

Route::get('department_chief/departments', 'DepartmentChiefController@getAllDepartments');

Route::get('department_chief/hospitals', 'DepartmentChiefController@getAllHospitals');

Route::get('department_chief', 'DepartmentChiefController@getDepartmentInpatients');

Route::post('department_chief/addAttendingDoctorToInpatient', 'DepartmentChiefController@addAttendingDoctorToInpatient');

Route::post('department_chief/dischargeInpatient', 'DepartmentChiefController@dischargeInpatientFromDepartment');

Route::get('head_physician', function () {
    return view('headPhysician');
});

//----------Nurse-------------------------------



Route::get('nurse', function () {
    /*return view('layouts.emergency_room');*/
    return view('nurse');
});

Route::get('nurse/departments', 'NurseController@getDepartments'); //+

Route::get('nurse/department/{id}/chambers', 'NurseController@getDepartmentChambers');//+

Route::get('nurse/chamber/{id}', 'NurseController@getChamberWithPatients');//+

Route::get('nurse/inpatient/{id}', 'NurseController@getInpatientInfo');//+ TODO еще согласовать поля

Route::get('nurse/inpatient/{id}/inspection_protocol', 'NurseController@getInpatientInspectionProtocol');

Route::get('nurse/inpatient/{id}/medical_appointments', 'NurseController@getInpatientMedicalAppointments');

Route::get('nurse/inpatient/{id}/inspections', 'NurseController@getInpatientInspections');

Route::get('nurse/inpatient/{id}/analyzes', 'NurseController@getInpatientAllAnalyzes');//получить список всех анализов пациента

Route::get('nurse/inpatient/{id}/analyzes/{analyses_id}', 'NurseController@getInpatientAnalyses');//получить информацию по конретному анализу по его id

Route::get('nurse/inpatient/{id}/procedures', 'NurseController@getInpatientAllProcedures');//получить список всех процедур пациента

Route::get('nurse/inpatient/{id}/procedures/{procedure_id}', 'NurseController@getInpatientProcedure');//получить информацию по конретной процедуре по его id

Route::get('nurse/inpatient/{id}/operations', 'NurseController@getInpatientOperations');

Route::get('nurse/inpatient/{id}/temperature_log', 'NurseController@getInpatientTemperatureLog'); // получить все измерения температур пациента

//no important ---------------------------------------
Route::get('nurse/chambers', 'NurseController@getNotEmptyChambers');

Route::get('nurse/allChambers', 'NurseController@getChambers');

Route::get('nurse/testFunc', 'NurseController@testFunc');
//----------

Route::get('/', function () {
    return view('welcome');
});

Route::get('files/getFile', 'FileController@getFile'); //получить файл по его урлу {file_path}

Route::post('files/saveFile', 'FileController@saveFile');

