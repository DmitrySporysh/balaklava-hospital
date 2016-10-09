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

    public function getChambers(Request $request)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;


        $response = $this->nurse_service->getAllChambersWithDepartment($perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function getNotEmptyChambers(Request $request)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;


        $response = $this->nurse_service->getNotEmptyChambersWithDepartment($perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function testFunc(Request $request)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;


        $response = $this->nurse_service->testFunc($perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function getChamber(Request $request, $chamber_id)
    {
        Debugbar::addMessage('Another message', 'mylabel');

        $response = $this->nurse_service->getChamberFullInfo($chamber_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function getPatient(Request $request, $id)
    {
        Debugbar::addMessage('Another message', 'mylabel');

        $response = $this->nurse_service->getPatientWithTableInfo($id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function dressings(Request $request, $patient_id)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;

        $response = $this->nurse_service->getPatientDressings($patient_id, $perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function inspections(Request $request, $patient_id)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;

        $response = $this->nurse_service->getPatientInspections($patient_id, $perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function operations(Request $request, $patient_id)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;

        $response = $this->nurse_service->getPatientOperations($patient_id, $perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function surveys(Request $request, $patient_id)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;

        $response = $this->nurse_service->getPatientSurveys($patient_id, $perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function treatments(Request $request, $patient_id)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $perPage = ($request->has('per_page')) ? $request->per_page : 3;

        $response = $this->nurse_service->getPatientTreatments($patient_id, $perPage);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }


}
