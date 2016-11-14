<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\Interfaces\DoctorServiceInterface;
use App\Services\Interfaces\PatientServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;

class DoctorController extends Controller
{
    private $doctor_service;
    private $patient_service;

    public function __construct(DoctorServiceInterface $doctor_service,
                                PatientServiceInterface $patient_service
    )
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $this->doctor_service = $doctor_service;
        $this->patient_service = $patient_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function getDoctorInpatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $doctor_id = 19; //TODO брать ид авторизованного доктора
        $response = $this->doctor_service->getDoctorAllInpatientsSortByDateDesc($doctor_id, $per_page);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getAwaitingPrimaryInspectionPatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $response = $this->patient_service->getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($per_page);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getReceivedPatient(Request $request, $received_patient_id)
    {
        $response = $this->patient_service->getReceivedPatientFullInfo($received_patient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientInfo(Request $request, $inpatient_id)
    {
        $response = $this->patient_service->getInpatientGeneralInfo($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getPatientsArchive(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $response = $this->patient_service->getPatientsArchive($per_page, $request);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientAllInfo(Request $request, $inpatient_id)
    {

        $response = $this->patient_service->getInpatientAllInfo($inpatient_id);
        ///Debugbar::info($response);
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
        $response = $this->patient_service->getInpatientAllAnalyzes($inpatient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }

    public function getInpatientProcedures(Request $request, $patient_id)
    {
        $response = $this->patient_service->getInpatientAllProcedures($patient_id);
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



    //----------------------------------------------------------------------------------
    //TODO Post requests
    //---------------------------------------------------------------------------------
    public function addNewInpatientAnalysis(Request $request)
    {
        $doctor_id = 19; //TODO брать ид авторизованного доктора

        $response = $this->doctor_service->addNewInpatientAnalysis($request, $doctor_id);

        return $response;
    }

    public function addNewInpatientProcedure(Request $request)
    {
        $doctor_id = 19; //TODO брать ид авторизованного доктора

        $response = $this->doctor_service->addNewInpatientProcedure($request, $doctor_id);

        return $response;
    }

    public function addNewInpatientInspection(Request $request)
    {
        $doctor_id = 19; //TODO брать ид авторизованного доктора

        $response = $this->doctor_service->addNewInpatientInspection($request, $doctor_id);

        return $response;
    }

    public function addNewInpatientOperation(Request $request)
    {
        $doctor_id = 19; //TODO брать ид авторизованного доктора

        $response = $this->doctor_service->addNewInpatientOperation($request, $doctor_id);

        return $response;
    }

    public function addNewInpatientMedicalAppointment(Request $request)
    {
        $doctor_id = 19; //TODO брать ид авторизованного доктора

        $response = $this->doctor_service->addNewInpatientMedicalAppointment($request, $doctor_id);

        return $response;
    }


    public function addNewInspectionProtocol(Request $request)
    {
        $doctor_id = 19; //TODO брать ид авторизованного доктора

        $response = $this->doctor_service->addNewInspectionProtocol($request, $doctor_id);

        return $response;
    }



}
