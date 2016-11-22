<?php

namespace App\Http\Controllers;

use App\Common\Enums\MessageUserRole;
use App\Common\Enums\UserRole;
use App\Http\Requests;
use App\Services\Interfaces\DepartmentChiefServiceInterface;
use App\Exceptions\DALException;
use App\Exceptions\HealthWorkerServiceException;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Validator;

class DepartmentChiefController extends Controller
{
    private $departmentChief_service;
    private $patientService;

    public function __construct(DepartmentChiefServiceInterface $departmentChief_service,
    PatientServiceInterface $patientService)
    {
        $this->middleware('auth');
        $this->middleware('checkPost:'.UserRole::DEPARTMENT_CHIEF);

        $this->departmentChief_service = $departmentChief_service;
        $this->patientService = $patientService;
    }

    public function getDepartmentInpatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $department_id = Auth::user()->health_worker->hospital_department->id; //TODO берем id отделения, которым управляет наш зав
        $response = $this->departmentChief_service->getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page);
        //Debugbar::info($response);
        //return view('index', ['response' => $response]);
        return $response;
    }

    public function getInpatientInfo(Request $request, $inpatient_id)
    {
        $response = $this->patientService->getInpatientGeneralInfo($inpatient_id);
        //Debugbar::info($response);
        //return view('index', ['response' => $response]);
        return $response;
    }

    public function getDepartmentDoctors(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $department_id = Auth::user()->health_worker->hospital_department->id; //TODO берем id отделения, которым управляет наш зав
        $response = $this->departmentChief_service->getDepartmentAllDoctorsSortByFio($department_id, $per_page);
        //Debugbar::info($response);
        //return view('index', ['response' => $response]);
        return $response;
    }

    public function getAllDepartments(Request $request)
    {
        $response = $this->departmentChief_service->getAllDepartments();
        //Debugbar::info($response);
        //return view('index', ['response' => $response]);
        return $response;
    }

    public function getAllHospitals(Request $request)
    {
        $response = $this->departmentChief_service->getAllHospitals();
        //Debugbar::info($response);
        //return view('index', ['response' => $response]);
        return $response;
    }

    //----------------------------------------------------------------------------------
    //TODO Post requests
    //---------------------------------------------------------------------------------
    public function addAttendingDoctorToInpatient(Request $request)
    {
        $response = $this->departmentChief_service->addAttendingDoctorToInpatient($request->all());
        return $response;
    }

    public function dischargeInpatientFromDepartment(Request $request)
    {
        $response = $this->departmentChief_service->dischargeInpatientFromDepartment($request->all());
        return $response;
    }

}
