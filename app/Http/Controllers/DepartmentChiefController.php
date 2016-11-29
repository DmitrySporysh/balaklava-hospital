<?php

namespace App\Http\Controllers;

use App\Common\Enums\MessageUserRole;
use App\Common\Enums\UserRole;
use App\Http\Requests;
use App\Services\Interfaces\CommonServiceInterface;
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
    private $commonService;

    public function __construct(DepartmentChiefServiceInterface $departmentChief_service,
                                PatientServiceInterface $patientService,
                                CommonServiceInterface $commonService)
    {
        $this->middleware('auth');
        $this->middleware('checkPost:' . UserRole::department_chief);

        $this->departmentChief_service = $departmentChief_service;
        $this->patientService = $patientService;
        $this->commonService = $commonService;
    }

    public function getDepartmentInpatients(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $department_id = Auth::user()->health_worker->department_id;
            $response = $this->departmentChief_service->getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInfo(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patientService->getInpatientGeneralInfo($inpatient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getDepartmentDoctors(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $department_id = Auth::user()->health_worker->department_id;
            $response = $this->departmentChief_service->getDepartmentAllDoctorsSortByFio($department_id, $per_page);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAllDepartments(Request $request)
    {
        try {
            $response = $this->commonService->getAllDepartments();
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAllHospitals(Request $request)
    {
        try {
            $response = $this->commonService->getAllHospitals();
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getPatientsArchive(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $response = $this->patientService->getPatientsArchive($per_page, $request);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    //----------------------------------------------------------------------------------
    //TODO Post requests
    //---------------------------------------------------------------------------------
    public function addAttendingDoctorToInpatient(Request $request)
    {
        try {
            $result = $this->departmentChief_service->addAttendingDoctorToInpatient($request->json()->all());
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function dischargeInpatientFromDepartment(Request $request)
    {
        try {
            $result = $this->departmentChief_service->dischargeInpatientFromDepartment($request->json()->all());
            Debugbar::info($result);
            return $result;
        } catch (Exception $e) {
            Debugbar::info(['success' => false, 'message' => $e->getMessage()]);
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
