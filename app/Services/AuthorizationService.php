<?php


namespace App\Services;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface AuthorizationServiceInterface
{
    public function login(Request $request);
    
    public function logout();
}