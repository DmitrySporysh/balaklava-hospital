<?php


namespace App\Services\Interfaces;
use Auth;
use Illuminate\Http\Request;
use Validator;
use Mail;
use Hash;


interface DepartmentChiefServiceInterface
{
    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $page_size);
}