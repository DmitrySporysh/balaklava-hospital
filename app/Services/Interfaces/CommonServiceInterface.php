<?php


namespace App\Services\Interfaces;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface CommonServiceInterface
{
    public function getAllDepartments();

    public function getAllHospitals();
}