<?php

namespace App\Http\Controllers;

use App\Common\Enums\MessageUserRole;
use App\Http\Requests;
use App\Services\Interfaces\EmergencyServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Exceptions\DALException;
use App\Exceptions\HealthWorkerServiceException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Validator;

class EmergencyController extends Controller
{
    private $emergency_service;

    public function __construct(EmergencyServiceInterface $emergency_service)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $this->emergency_service = $emergency_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function getReceivedPatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $response = $this->emergency_service->getAllReceivedPatientsSortByDateDesc($per_page);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function addNewInpatient(Request $request)
    {
        $registration_nurse_id = 5; //TODO брать ид авторизованной медсестры

        $response = $this->emergency_service->addNewPatient($request, $registration_nurse_id);
        //Debugbar::info($response);
        return json_encode('success');
    }
}
