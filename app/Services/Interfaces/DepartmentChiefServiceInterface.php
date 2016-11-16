<?php


namespace App\Services\Interfaces;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface DepartmentChiefServiceInterface
{
    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $page_size);

    public function getDepartmentAllDoctorsSortByFio($department_id, $page_size);

    public function getAllDepartments();

    public function getAllHospitals();

    public function addAttendingDoctorToInpatient($doctor_id, $inpatient_id);

    public function dischargeInpatientFromDepartment($requestData);
}