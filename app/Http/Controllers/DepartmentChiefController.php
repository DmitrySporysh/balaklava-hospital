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
    PatientServiceInterface $patientService
)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $this->departmentChief_service = $departmentChief_service;
        $this->patientService = $patientService;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::DEPARTMENT_CHIEF);
    }

    public function getDepartmentInpatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        //$department_id = Auth::user()->health_worker->hospital_department->id; //TODO берем id отделения, которым управляет наш зав
        $department_id = 1;
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

        //$department_id = Auth::user()->health_worker->hospital_department->id; //TODO берем id отделения, которым управляет наш зав
        $department_id = 1;
        $response = $this->departmentChief_service->getDepartmentAllDoctorsSortByFio($department_id, $per_page);
        Debugbar::info($response);
        return view('index', ['response' => $response]);
        //return $response;
    }

}
