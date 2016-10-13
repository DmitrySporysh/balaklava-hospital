<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Services\Interfaces\HealthWorkerServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Exceptions\DALException;
use App\Exceptions\HealthWorkerServiceException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;

class HealthWorkerController extends Controller
{
    private $healthworker_service;

    public function __construct(HealthWorkerServiceInterface $healthworker_service)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $this->healthworker_service = $healthworker_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function patients(Request $request)
    {
        //$per_page = ($request->has('per_page')) ? $request->per_page : 3;

        $response = $this->healthworker_service->getAllPatientsFio();
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getPatient($patient_id)
    {
        Debugbar::addMessage('HealthWorkerController/getPatient', 'mylabel');

        $response = $this->healthworker_service->getPatietnFullInfo($patient_id);
        //$response =  $this->healthworker_service->testFunc();
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
    }

    public function addPatient(Request $request)
    {
        Debugbar::info($request);

        try {
            $response = $this->healthworker_service->addNewPatient($request);
            return json_encode("Success adding patient");
        } catch (HealthWorkerServiceException $e) {
            return json_encode("Error");
        } catch (Exception $e) {
            return json_encode("Error");
        }
    }
}
