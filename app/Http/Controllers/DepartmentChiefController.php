<?php

namespace App\Http\Controllers;

use App\Common\Enums\MessageUserRole;
use App\Http\Requests;
use App\Services\Interfaces\DepartmentChiefServiceInterface;
use App\Exceptions\DALException;
use App\Exceptions\HealthWorkerServiceException;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Input;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Validator;

class DepartmentChiefController extends Controller
{
    private $departmentChief_service;

    public function __construct(DepartmentChiefServiceInterface $departmentChief_service)
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $this->departmentChief_service = $departmentChief_service;

        //$this->middleware('auth');
        //$this->middleware('checkRole:'.UserRole::WEBMASTER);
    }

    public function getDepartmentInpatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $department_id = 1;
        $response = $this->departmentChief_service->getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

    public function getAwaitingPrimaryInspectionPatients(Request $request)
    {
        $per_page = ($request->has('per_page')) ? $request->per_page : 20;

        $response = $this->departmentChief_service->getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($per_page);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }

}
