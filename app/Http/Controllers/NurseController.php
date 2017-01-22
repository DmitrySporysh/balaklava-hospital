<?php

namespace App\Http\Controllers;

use App\Common\Enums\UserRole;
use App\Services\Interfaces\NurseServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use Exception;
use Illuminate\Http\Request;


class NurseController extends Controller
{
    private $nurse_service;
    private $patient_service;

    private function checkPost()
    {
        $this->middleware('auth');
        $this->middleware('checkRole:' . UserRole::medical_nurse);
    }

    public function __construct(NurseServiceInterface $nurse_service,
                                PatientServiceInterface $patient_service
    )
    {
        //$this->checkPost();
        $this->nurse_service = $nurse_service;
        $this->patient_service = $patient_service;
    }


    public function getDepartments()
    {
        try {
            return $this->nurse_service->getAllDepartmentsWithDepartmentChiefFio();
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getDepartmentChambers($department_id)
    {
        try {
            return $this->nurse_service->getDepartmentChambers($department_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }


    public function getChamberWithPatients($chamber_id)
    {
        try {
            return $this->nurse_service->getChamberWithPatients($chamber_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInfo($inpatient_id)
    {
        try {
            // TODO потом потестить
            return $this->patient_service->getInpatientWithGeneralInfoAndAttendingDoctor($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInspectionProtocol($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientInspectionProtocolInfo($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientMedicalAppointments($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientMedicalAppointments($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientInspections($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientInspections($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientAllAnalyzes($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientAllAnalyzes($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientAnalyses($inpatient_id, $analyses_id)
    {
        try {
            return $this->patient_service->getInpatientAnalyses($inpatient_id, $analyses_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientAllProcedures($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientAllProcedures($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientProcedure($inpatient_id, $procedure_id)
    {
        try {
            return $this->patient_service->getInpatientProcedure($inpatient_id, $procedure_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientOperations($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientOperations($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function getInpatientTemperatureLog($inpatient_id)
    {
        try {
            return $this->patient_service->getInpatientTemperatureLog($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}
