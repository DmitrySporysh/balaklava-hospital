<?php

namespace App\Http\Controllers;

use App\Common\Enums\UserRole;
use App\Services\Interfaces\MedicalNurseServiceInterface;
use App\Exceptions\DALException;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Validator;

class MedicalNurseController extends Controller
{
    private $medicalNurseService;
    private $patientService;

    public function __construct(MedicalNurseServiceInterface $medicalNurseService,
                                PatientServiceInterface $patientService)
    {
        $this->middleware('auth');
        $this->middleware('checkPost:' . UserRole::medical_nurse);

        $this->medicalNurseService = $medicalNurseService;
        $this->patientService = $patientService;
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

    //----------------------------------------------------
    //TODO  methods for analyzes nurse
    //------------------------------------------------
    public function getAllNotReadyAnalyzes()
    {
        try {
            $response = $this->medicalNurseService->getAllNotReadyAnalyzes();
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addAnalysisResult(Request $request)
    {
        try {
            $registration_nurse_id = Auth::user()->health_worker->id;; //TODO брать ид авторизованной медсестры
            $result = $this->medicalNurseService->addAnalysisResult($request->all(), $registration_nurse_id);
            return $result;
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
            $response = $this->medicalNurseService->getAllReceivedPatientsSortByDateDesc($per_page);
            return $response;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function addNewInpatient(Request $request)
    {
        try {
            $registration_nurse_id = Auth::user()->health_worker->id;; //TODO брать ид авторизованной медсестры
            $result = $this->medicalNurseService->addNewPatient($request->json()->all(), $registration_nurse_id);
            return $result;
        } catch (Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }
}



