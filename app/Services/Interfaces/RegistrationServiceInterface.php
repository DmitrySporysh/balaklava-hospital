<?php


namespace App\Services\Interfaces;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface RegistrationServiceInterface
{
    public function register(Request $request);
}