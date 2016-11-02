<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\NurseServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
//Exceptions
use App\Exceptions\DALException;
use App\Exceptions\NurseServiceException;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Input;
//Debufbar
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
    public function getInpatientAnalyzes(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientAnalyzes($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientProcedures(Request $request, $patient_id)
    {
        $response = $this->patient_service->getInpatientProcedures($patient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientOperations(Request $request, $patient_id)
    {
        $response = $this->patient_service->getInpatientOperations($patient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientTemperatureLog(Request $request, $patient_id)
    {
        $response = $this->patient_service->getInpatientTemperatureLog($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }
}
