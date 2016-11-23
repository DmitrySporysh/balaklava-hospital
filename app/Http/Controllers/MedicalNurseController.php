<?php

namespace App\Http\Controllers;

use App\Common\Enums\UserRole;
use App\Http\Requests;
use App\Services\Interfaces\MedicalNurseServiceInterface;
use App\Exceptions\DALException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Validator;

class MedicalNurseController extends Controller
{
    private $medicalNurseService;

    public function __construct(MedicalNurseServiceInterface $medicalNurseService)
    {
        $this->middleware('auth');
        $this->middleware('checkPost:' . UserRole::NURSE);

        $this->medicalNurseService = $medicalNurseService;
    }

    //----------------------------------------------------
    //TODO  methods for analyzes nurse
    //------------------------------------------------
    //gett
    public function getAllNotReadyAnalyzes()
    {
        $response = $this->medicalNurseService->getAllNotReadyAnalyzes();
        //Debugbar::info($response);
        //return view('index');
        return $response;
    }

    //post
    public function addAnalysisResult(Request $request)
    {
        $registration_nurse_id = Auth::user()->health_worker->id;; //TODO брать ид авторизованной медсестры

        $result =$this->medicalNurseService->addAnalysisResult($request->all(), $registration_nurse_id);
        return $result;
    }

    //TODO methods for emergency
    public function getReceivedPatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $response = $this->medicalNurseService->getAllReceivedPatientsSortByDateDesc($per_page);
        return $response;
    }

    public function addNewInpatient(Request $request)
    {
        Debugbar::info($request->all());
        return 'fgf';
        $registration_nurse_id = Auth::user()->health_worker->id;; //TODO брать ид авторизованной медсестры

        $result =$this->medicalNurseService->addNewPatient($request->all(), $registration_nurse_id);
        return $result;
    }
}



