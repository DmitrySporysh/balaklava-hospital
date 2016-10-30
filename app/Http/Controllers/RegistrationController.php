<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\RegistrationServiceInterface;
use App\Exceptions\RegistrationServiceException;
use Exception;
use App\Http\Requests;
use Auth;

use Barryvdh\Debugbar\Facade;
use Debugbar;

class RegistrationController extends Controller
{
    private $reg_service;


    public function __construct(RegistrationServiceInterface $register_service)
    {
        $this->reg_service = $register_service;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        Debugbar::info($request->all());
        //return view('welcome', ['response' => $response]);

        $messages = $this->reg_service->register($request);

        Debugbar::info($messages);

        return  $messages;

    }
}
