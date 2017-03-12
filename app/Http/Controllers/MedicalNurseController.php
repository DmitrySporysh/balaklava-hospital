<?php

namespace App\Http\Controllers;

use App\Common\Enums\UserRole;
use App\Services\Interfaces\MedicalNurseServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\Request;
use Exception;

class MedicalNurseController extends Controller
{
    private $medicalNurseService;
    private $patientService;

    private function checkPost()
    {
        $this->middleware('auth');
        $this->middleware('checkPost:' . UserRole::medical_nurse);
    }

    public function __construct(MedicalNurseServiceInterface $medicalNurseService,
                                PatientServiceInterface $patientService)
    {
        $this->checkPost();
        $this->medicalNurseService = $medicalNurseService;
        $this->patientService = $patientService;
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

    public function getInpatientAllInfo($inpatient_id)
    {
        try {
            return $this->patientService->getInpatientAllInfo($inpatient_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    //----------------------------------------------------
    //TODO  methods for analyzes nurse
    //------------------------------------------------
    public function getAllNotReadyAnalyzes()
    {
        try {
            return $this->medicalNurseService->getAllNotReadyAnalyzes();
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addAnalysisResult(Request $request)
    {
        try {
            $registration_nurse_id = $request->session()->get('health_worker_id');
            return $this->medicalNurseService->addAnalysisResult($request->all(), $registration_nurse_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /*----------------------------------------------------
    //  methods for emergency nurse
    //------------------------------------------------*/
    public function getReceivedPatients(Request $request)
    {
        try {
            $per_page = ($request->has('per_page')) ? $request->per_page : 20;
            return $this->medicalNurseService->getAllReceivedPatientsSortByDateDesc($per_page);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addNewInpatient(Request $request)
    {
        try {
            $registration_nurse_id = $request->session()->get('health_worker_id');
            return $this->medicalNurseService->addNewPatient($request->json()->all(), $registration_nurse_id);
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}



