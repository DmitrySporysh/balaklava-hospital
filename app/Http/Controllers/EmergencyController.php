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
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function getPatient($patient_id)
    {
        Debugbar::addMessage('HealthWorkerController/getPatient', 'mylabel');

        //$response = $this->healthworker_service->getPatietnFullInfo($patient_id);
        //$response =  $this->healthworker_service->testFunc();
        Debugbar::info(MessageUserRole::values);
        Debugbar::info(MessageUserRole::getValueByNumber(1));
        Debugbar::info(MessageUserRole::getValueByNumber(0));
        Debugbar::info(MessageUserRole::getValueByNumber(3));

        return view('welcome');
    }

    public function addPatient(Request $request)
    {
        Debugbar::info($request);

        try {
            $validator = Validator::make($request->all(), [
                'fio' => 'required|min:8',
                'sex' => 'required|in:male,female'
            ]);

            $validator->validate();

            $request->session()->put('temp', 'ура работает');

            $response = $this->emergency_service->addNewPatient($request);
            return json_encode("Success adding patient");
        } catch (HealthWorkerServiceException $e) {
            return json_encode("Error whil");
        } catch (Exception $e) {
            return json_encode("Error");
        }
    }
}
