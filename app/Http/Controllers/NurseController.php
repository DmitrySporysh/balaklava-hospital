<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\NurseServiceInterface;
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

    public function __construct(NurseServiceInterface $nurse_service)
    {
        $this->nurse_service = $nurse_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function getDepartments(Request $request)
    {
        $response = $this->nurse_service->getAllDepartments();
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function getDepartmentChambers(Request $request, $department_id)
    {
        $response = $this->nurse_service->getDepartmentChambers($department_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }


    public function getChamber(Request $request, $chamber_id)
    {
        $response = $this->nurse_service->getChamberFullInfo($chamber_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function getPatient(Request $request, $patient_id)
    {
        $response = $this->nurse_service->getPatientWithTableInfo($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function dressings(Request $request, $patient_id)
    {
        $response = $this->nurse_service->getPatientDressings($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function inspections(Request $request, $patient_id)
    {
        $response = $this->nurse_service->getPatientInspections($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function operations(Request $request, $patient_id)
    {
        $response = $this->nurse_service->getPatientOperations($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function surveys(Request $request, $patient_id)
    {
        $response = $this->nurse_service->getPatientSurveys($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function treatments(Request $request, $patient_id)
    {
        $response = $this->nurse_service->getPatientTreatments($patient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }
}
