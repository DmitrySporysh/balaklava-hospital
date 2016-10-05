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
    
    public function patients()
    {
        Debugbar::addMessage('Another message', 'mylabel');
        $page_size = 3;

        $response = $this->healthworker_service->getAllPatients($page_size);
        return $response;
    }
}
