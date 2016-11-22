<?php

namespace App\Http\Controllers\Auth;

use App\Common\Enums\UserRole;
use App\Exceptions\AuthServiceException;
use Auth;
use App\Models\ConfirmUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Mail;
use Hasdh;
use App\Services\Interfaces\AuthorizationServiceInterface;

use Barryvdh\Debugbar\Facade;
use Debugbar;



class AuthController extends Controller
{

    private $auth_service;
   

    public function __construct(AuthorizationServiceInterface $auth_service)
    {
        $this->auth_service = $auth_service;
     
    }

    public function showLoginForm()
    {
        return view('index');
    }

    public function login(Request $request){

        try {
            $errors = $this->auth_service->login($request);

            if(!empty($errors)) {
                return $errors;
            }

            if(Auth::guest()){
                return redirect('/');
            }

            $post = Auth::user()->health_worker->post;

            return ['success' => true, 'post' => $post];

            /*
            if($role == UserRole::getValueByNumber(0)){
                
                return redirect('/department_chief');
            }
            if($role == UserRole::getValueByNumber(1)){

                return redirect('/nurse');
            }
            if($role == UserRole::getValueByNumber(2)){
                return redirect('/doctor');
            }
            if($role == UserRole::getValueByNumber(3)){
                return redirect('/emergency');
            }*/
        }
        catch(AuthServiceException $e) {
            return $e->getMessage();
        }
        catch(Exception $e) {
            return 'Неизвестная ошибка логина.';
        }
    }

   

    public function logout(Request $request)
    {
        $this->auth_service->logout($request);
        return redirect('login#/login');
    }

}
