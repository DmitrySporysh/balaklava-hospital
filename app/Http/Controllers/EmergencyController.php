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
        Debugbar::addMessage('fffffff');
        Debugbar::info($request);

        try {
            /*$validator = Validator::make($request->all(), [
                'fio' => 'required|min:8',
                'sex' => 'required|in:male,female'
            ]);

            $validator->validate();*/

            $response = $this->emergency_service->addNewPatient($request);
            //Debugbar::info($response);
            return json_encode('success');

            /*$request->session()->put('temp', 'ура работает');

            $this->emergency_service->addNewPatient($request);

            return json_encode("Success adding patient");*/

        } catch (HealthWorkerServiceException $e) {
            return json_encode($e->getMessage());
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }
}
