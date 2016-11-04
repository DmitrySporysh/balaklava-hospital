<?php

namespace App\Http\Controllers;

use App\Services\Interfaces\NurseServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;

use Illuminate\Http\Request;

//Debugbar
use Barryvdh\Debugbar\Facade;
use Debugbar;


class NurseController extends Controller
{
    private $nurse_service;
    private $patient_service;

    public function __construct(NurseServiceInterface $nurse_service,
                                PatientServiceInterface $patient_service
    )
    {
        $this->nurse_service = $nurse_service;
        $this->patient_service = $patient_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function getDepartments(Request $request)
    {
        $response = $this->nurse_service->getAllDepartmentsWithDepartmentChiefFio();
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getDepartmentChambers(Request $request, $department_id)
    {
        $response = $this->nurse_service->getDepartmentChambers($department_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }


    public function getChamberWithPatients(Request $request, $chamber_id)
    {
        $response = $this->nurse_service->getChamberWithPatients($chamber_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientInfo(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientWithGeneralInfoAndAttendingDoctor($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientInspectionProtocol(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientInspectionProtocolInfo($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientMedicalAppointments(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientMedicalAppointments($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientInspections(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientInspections($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientAllAnalyzes(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientAllAnalyzes($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientAnalyses(Request $request, $inpatient_id, $analyses_id)
    {
        $response = $this->patient_service->getInpatientAnalyses($inpatient_id, $analyses_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientAllProcedures(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientAllProcedures($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientProcedure(Request $request, $inpatient_id, $procedure_id)
    {
        $response = $this->patient_service->getInpatientProcedure($inpatient_id, $procedure_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientOperations(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientOperations($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientTemperatureLog(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientTemperatureLog($inpatient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }
}
