<?php


namespace App\Services\Interfaces;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface RegistrationServiceInterface
{
    public function registerConfirmUser(Request $request);

    public function checkIfConfirmUserExist($token);

    public function register(Request $request);
}