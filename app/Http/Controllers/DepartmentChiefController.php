<?php

namespace App\Http\Controllers;

use App\Common\Enums\UserRole;
use App\Http\Requests;
use App\Services\Interfaces\CommonServiceInterface;
use App\Services\Interfaces\DepartmentChiefServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\Request;
use Exception;


class DepartmentChiefController extends Controller
{
    private $departmentChief_service;
    private $patientService;
    private $commonService;

    private function checkPost()
    {
        $this->middleware('auth');
        $this->middleware('checkPost:' . UserRole::department_chief);
    }

    public function __construct(DepartmentChiefServiceInterface $departmentChief_service,
                                PatientServiceInterface $patientService,
                                CommonServiceInterface $commonService)
    {
        $this->checkPost();
        $this->departmentChief_service = $departmentChief_service;
        $this->patientService = $patientService;
        $this->commonService = $commonService;
    }


    public function getDepartmentInpatients(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $department_id = $request->session()->get('health_worker_id');
            return $this->departmentChief_service->getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInfo(Request $request, $inpatient_id)
    {
        try {
            return $this->patientService->getInpatientGeneralInfo($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getDepartmentDoctors(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $department_id = $request->session()->get('health_worker_id');
            return $this->departmentChief_service->getDepartmentAllDoctorsSortByFio($department_id, $per_page);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAllDepartments(Request $request)
    {
        try {
            return $this->commonService->getAllDepartments();
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAllHospitals(Request $request)
    {
        try {
            return $this->commonService->getAllHospitals();
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getPatientsArchive(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            return $this->patientService->getPatientsArchive($per_page, $request);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientAllInfo(Request $request, $inpatient_id)
    {
        try {
            return $this->patientService->getInpatientAllInfo($inpatient_id);
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
            return $this->departmentChief_service->addAttendingDoctorToInpatient($request->json()->all());
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function dischargeInpatientFromDepartment(Request $request)
    {
        try {
            return $this->departmentChief_service->dischargeInpatientFromDepartment($request->json()->all());
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

}
