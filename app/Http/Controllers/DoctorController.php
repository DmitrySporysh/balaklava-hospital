<?php

namespace App\Http\Controllers;

use App\Common\Enums\UserRole;
use App\Exceptions\CommonServiceException;
use App\Http\Requests;
use App\Services\Interfaces\CommonServiceInterface;
use App\Services\Interfaces\DoctorServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;

class DoctorController extends Controller
{
    private $doctor_service;
    private $patient_service;
    private $commonService;

    public function __construct(DoctorServiceInterface $doctor_service,
                                PatientServiceInterface $patient_service,
                                CommonServiceInterface $commonService
    )
    {
        $this->middleware('auth');
        $this->middleware('checkPost:' . UserRole::doctor);

        $this->doctor_service = $doctor_service;
        $this->patient_service = $patient_service;
        $this->commonService = $commonService;
    }

    public function getDoctorInpatients(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $doctor_id = Auth::user()->health_worker->id;
            $response = $this->doctor_service->getDoctorAllInpatientsSortByDateDesc($doctor_id, $per_page);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getAwaitingPrimaryInspectionPatients(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $response = $this->patient_service->getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($per_page);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getReceivedPatient(Request $request, $received_patient_id)
    {
        try {
            $response = $this->patient_service->getReceivedPatientFullInfo($received_patient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInfo(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patient_service->getInpatientGeneralInfo($inpatient_id);
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

    public function getPatientsArchive(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            $response = $this->patient_service->getPatientsArchive($per_page, $request);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientAllInfo(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patient_service->getInpatientAllInfo($inpatient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInspectionProtocol(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patient_service->getInpatientInspectionProtocolInfo($inpatient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientMedicalAppointments(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patient_service->getInpatientMedicalAppointments($inpatient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInspections(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patient_service->getInpatientInspections($inpatient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientAnalyzes(Request $request, $inpatient_id)
    {
        try {
            $response = $this->patient_service->getInpatientAllAnalyzes($inpatient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientProcedures(Request $request, $patient_id)
    {
        try {
            $response = $this->patient_service->getInpatientAllProcedures($patient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientOperations(Request $request, $patient_id)
    {
        try {
            $response = $this->patient_service->getInpatientOperations($patient_id);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    //----------------------------------------------------
    //TODO  methods for operating doctor
    //------------------------------------------------
    public function getAllNotReadyOperations()
    {
        try {
            $response = $this->doctor_service->getAllNotReadyOperations();
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addOperationResult(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;;
            $result = $this->doctor_service->addOperationResult($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    //----------------------------------------------------------------------------------
    //TODO Post requests
    //---------------------------------------------------------------------------------
    public function addNewInpatientAnalysis(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;
            $result = $this->doctor_service->addNewInpatientAnalysis($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addNewInpatientProcedure(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;
            $result = $this->doctor_service->addNewInpatientProcedure($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addNewInpatientInspection(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;
            $result = $this->doctor_service->addNewInpatientInspection($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addNewInpatientOperation(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;
            $result =  $this->doctor_service->addNewInpatientOperation($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addNewInpatientMedicalAppointment(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;
            $result =  $this->doctor_service->addNewInpatientMedicalAppointment($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    public function addNewInspectionProtocol(Request $request)
    {
        try {
            $doctor_id = Auth::user()->health_worker->id;
            $result =  $this->doctor_service->addNewInspectionProtocol($request->json()->all(), $doctor_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


}
