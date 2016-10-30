<?php


namespace App\Services\Interfaces;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface AuthorizationServiceInterface
{
    public function login(Request $request);
    
    public function logout(Request $request);
}