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

    //TODO methods for emergency
    public function getReceivedPatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $response = $this->medicalNurseService->getAllReceivedPatientsSortByDateDesc($per_page);
        return $response;
    }

    public function addNewInpatient(Request $request)
    {
        $registration_nurse_id = Auth::user()->health_worker->id;; //TODO брать ид авторизованной медсестры

        $this->medicalNurseService->addNewPatient($request, $registration_nurse_id);
        return json_encode(['success' => true]);
    }
}



