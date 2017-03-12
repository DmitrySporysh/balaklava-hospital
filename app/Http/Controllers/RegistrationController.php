<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Interfaces\RegistrationServiceInterface;


class RegistrationController extends Controller
{
    private $reg_service;


    public function __construct(RegistrationServiceInterface $register_service)
    {
        $this->reg_service = $register_service;
    }

    public function register(Request $request)
    {
        $messages = $this->reg_service->register($request->all());
        return  $messages;
    }
}
