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


Route::get('/', function () {
    return view('index');
});

Route::get('nurse', function () {
    return view('nurse');
});
Route::get('head_physician', function () {
    return view('headPhysician');
});
Route::get('doctor', function () {
    return view('doctor');
});
Route::get('login', function () {
    return view('index');
});

Route::group(['prefix' => 'api'], function () {
    /*-------------------------------------------------------------------------------------------------
    *             Регистрация и Авторизация
    *------------------------------------------------------------------------------------------------- */
    Route::post('/register', 'RegistrationController@register');
    Route::post('/login', 'Auth\AuthController@login');
    Route::post('/logout', 'Auth\AuthController@logout');

    /*-------------------------------------------------------------------------------------------------
    *             ВРАЧИ
    *------------------------------------------------------------------------------------------------- */
    Route::group(['prefix' => 'doctor'], function () {
        /*
         * лечащий врач
         */
        Route::group(['prefix' => 'inpatient'], function () {
            Route::get('all', 'DoctorController@getDoctorInpatients'); //doctor#/patients
            Route::get('{id}', 'DoctorController@getInpatientInfo');
            Route::get('{id}/allInfo', 'DoctorController@getInpatientAllInfo');
            Route::get('{id}/inspection_protocol', 'DoctorController@getInpatientInspectionProtocol');
            Route::get('{id}/medical_appointments', 'DoctorController@getInpatientMedicalAppointments');
            Route::get('{id}/statesDynamics', 'DoctorController@getInpatientStatesDynamics');
            Route::get('{id}/analyzes', 'DoctorController@getInpatientAnalyzes');
            Route::get('{id}/procedures', 'DoctorController@getInpatientProcedures');
            Route::get('{id}/operations', 'DoctorController@getInpatientOperations');

            Route::post('addAnalysis', 'DoctorController@addNewInpatientAnalysis');
            Route::post('addProcedure', 'DoctorController@addNewInpatientProcedure');
            Route::post('addInspection', 'DoctorController@addNewInpatientInspection');
            Route::post('addOperation', 'DoctorController@addNewInpatientOperation');
            Route::post('addMedicalAppointment', 'DoctorController@addNewInpatientMedicalAppointment');
        });

        /*
         * дежурный врач
         */
        Route::group(['prefix' => 'emergency'], function () {
            Route::get('/', 'DoctorController@getAwaitingPrimaryInspectionPatients');
            Route::get('received_patient/{id}', 'DoctorController@getReceivedPatient');
            Route::post('addNewInspectionProtocol', 'DoctorController@addNewInspectionProtocol');
        });
        /*
         * операционый врач
         */
        Route::group(['prefix' => 'operation'], function () {
            Route::get('getAllNotReadyOperations', 'DoctorController@getAllNotReadyOperations');
            Route::post('addOperationResult', 'DoctorController@addOperationResult');
        });

        /*
         * общие запросы
         */

        Route::get('archive', 'DoctorController@getPatientsArchive');
        Route::get('departments', 'DoctorController@getAllDepartments');
    });

    /*-------------------------------------------------------------------------------------------------
    *             МЕДСЕСТРЫ
    *------------------------------------------------------------------------------------------------- */
    Route::group(['prefix' => 'medical_nurse'], function () {

        /*
         * медсестры регистратуры
         */
        Route::group(['prefix' => 'emergency'], function () {
            Route::get('received_patients', 'MedicalNurseController@getReceivedPatients');
            Route::post('addNewInpatient', 'MedicalNurseController@addNewInpatient');
        });

        /*
         * медсестры, принимающие анализы
         */
        Route::group(['prefix' => 'analyzes'], function () {
            Route::get('getAllNotReadyAnalyzes', 'MedicalNurseController@getAllNotReadyAnalyzes');
            Route::post('addAnalysisResult', 'MedicalNurseController@addAnalysisResult');
        });

        Route::get('archive', 'MedicalNurseController@getPatientsArchive');
        Route::get('inpatient/{id}/allInfo', 'MedicalNurseController@getInpatientAllInfo');
    });

    /*-------------------------------------------------------------------------------------------------
    *             ЗАВ ОТДЕЛЕНИЯ
    *------------------------------------------------------------------------------------------------- */
    Route::group(['prefix' => 'department_chief'], function () {
        Route::get('inpatients', 'DepartmentChiefController@getDepartmentInpatients');
        Route::get('inpatient/{id}', 'DepartmentChiefController@getInpatientInfo');
        Route::get('doctors', 'DepartmentChiefController@getDepartmentDoctors');
        Route::get('departments', 'DepartmentChiefController@getAllDepartments');
        Route::get('hospitals', 'DepartmentChiefController@getAllHospitals');
        Route::get('archive', 'DepartmentChiefController@getPatientsArchive');
        Route::get('inpatient/{id}/allInfo', 'DepartmentChiefController@getInpatientAllInfo');

        Route::post('addAttendingDoctorToInpatient', 'DepartmentChiefController@addAttendingDoctorToInpatient');
        Route::post('dischargeInpatient', 'DepartmentChiefController@dischargeInpatientFromDepartment');
    });

    //TODO Сервисы для моб приложения
    /*-------------------------------------------------------------------------------------------------
    *             МЕДСЕСТРЫ МОБ ВЕРСИЯ
    *------------------------------------------------------------------------------------------------- */
    Route::group(['prefix' => 'nurse'], function () {
        Route::get('departments', 'NurseController@getDepartments'); //+
        Route::get('department/{id}/chambers', 'NurseController@getDepartmentChambers');//+
        Route::get('chamber/{id}', 'NurseController@getChamberWithPatients');//+

        Route::group(['prefix' => 'inpatient'], function () {
            Route::get('{id}', 'NurseController@getInpatientInfo');
            Route::get('{id}/inspection_protocol', 'NurseController@getInpatientInspectionProtocol');
            Route::get('{id}/medical_appointments', 'NurseController@getInpatientMedicalAppointments');
            Route::get('{id}/statesDynamics', 'NurseController@getInpatientStatesDynamics');
            Route::get('{id}/analyzes', 'NurseController@getInpatientAllAnalyzes');
            Route::get('{id}/analyzes/{analyses_id}', 'NurseController@getInpatientAnalyses');
            Route::get('{id}/procedures', 'NurseController@getInpatientAllProcedures');
            Route::get('{id}/procedures/{procedure_id}', 'NurseController@getInpatientProcedure');
            Route::get('{id}/operations', 'NurseController@getInpatientOperations');
            Route::get('{id}/temperature_log', 'NurseController@getInpatientTemperatureLog');
        });
    });
});



Route::get('file', 'FileController@getFile'); //получить файл по его урлу {file_path}
Route::post('file/save', 'FileController@saveFile');

