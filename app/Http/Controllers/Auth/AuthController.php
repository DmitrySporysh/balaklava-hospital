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



class AuthController extends Controller
{

    private $auth_service;
   

    public function __construct(AuthorizationServiceInterface $auth_service)
    {
        $this->auth_service = $auth_service;
     
    }

    private function redirectToUserRolePage()
    {

    }
    public function login(Request $request){

        try {
            $errors = $this->auth_service->login($request);
            if(!empty($errors)) {
                return redirect('/entry')->withErrors($errors)->withInput();
            }

            if(Auth::guest()){
                return redirect('/index');
            }
            $role = Auth::user()->role;
            if($role == UserRole::WEBMASTER){
                
                return redirect('/webmaster');
            }
            if($role == UserRole::MODERATOR){

                return redirect('/moderator/banners');
            }
            if($role == UserRole::ADMIN){
                return redirect('/admin/applications');
            }
            if($role == UserRole::ADVERTISER){
                return redirect('/advertiser/profile');
            }
        }
        catch(AuthServiceException $e) {
            return 'Ошибка при логине. Временная заглушка.';
        }
        catch(Exception $e) {
            return 'Неизвестная ошибка логина. Временная заглушка.';
        }
    }

   

    public function logout()
    {
        $this->auth_service->logout();
        return redirect('/');
    }

}
