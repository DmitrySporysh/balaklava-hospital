<?php

namespace App\Http\Controllers;

use App\Common\Enums\MessageUserRole;
use App\Http\Requests;
use App\Services\Interfaces\DoctorServiceInterface;
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

class DoctorController extends Controller
{
    private $doctor_service;

    public function __construct(DoctorServiceInterface $doctor_service)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $this->doctor_service = $doctor_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function getDoctorInpatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $doctor_id = 2;
        $response = $this->doctor_service->getDoctorAllInpatientsSortByDateDesc($doctor_id, $per_page);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getAwaitingPrimaryInspectionPatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 100;

        $response = $this->doctor_service->getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($per_page);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getReceivedPatient(Request $request, $received_patient_id)
    {
        $response = $this->doctor_service->getReceivedPatientFullInfo($received_patient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }


    public function addNewInspectionProtocol(Request $request)
    {
        try {
            /*$validator = Validator::make($request->all(), [
                'fio' => 'required|min:8',
                'sex' => 'required|in:male,female'
            ]);

            $validator->validate();*/

            $response = $this->doctor_service->addNewInspectionProtocolWithPatient($request);
            //Debugbar::info($response);
            return json_encode('success');

            //$request->session()->put('temp', 'ура работает');

        } catch (HealthWorkerServiceException $e) {
            return json_encode($e->getMessage());
        } catch (Exception $e) {
            return json_encode($e->getMessage());
        }
    }

}
