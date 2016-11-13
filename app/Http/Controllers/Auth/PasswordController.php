<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\PasswordServiceException;
use App\Http\Controllers\Controller;
use App\Services\Interfaces\PasswordServiceInterface;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    private $pass_service;


    public function __construct(PasswordServiceInterface $pass_service)
    {
        $this->pass_service = $pass_service;

    }

    public function reset(Request $request){
        try {
            $errors = $this->pass_service->reset($request);
        
            if(!empty($errors)) {
                return redirect('/webmaster/changePassword')->withErrors($errors);
            }
            return redirect('/webmaster/profile');
        }
        catch(PasswordServiceException $e) {
            return 'Ошибка при регистрации';
        }
        catch(Exception $e) {
            return 'Неизвестная ошибка регистрации';
        }
    }

    public function forget(Request $request){
        try {
            $errors = $this->pass_service->forget($request);
            if(!empty($errors)) {
                return redirect('/forgetpassword')->withErrors($errors)->withInput();
            }
            //здесь должен быть редирект на страницу,где написано, что письмо успешно отправлено
            //и типа там будет кнопка "На главную"
            return $errors;
        }
        catch(PasswordServiceException $e) {
            return 'Ошибка при регистрации. Временная заглушка.';
        }
        catch(Exception $e) {
            return 'Неизвестная ошибка регистрации. Временная заглушка.';
        }
    }

    public function forgetAccept($token){

        try {
            $token_exist = $this->pass_service->checkIfForgetPasswordExist($token);
            if($token_exist==null) {
                return 'Неверный код верификации.';
            }
            return view('newPassword',['token' => $token]);
            //return view('/');
        }
        catch(PasswordServiceException $e) {
            return 'Ошибка при подтверждении мыла. Временная заглушка.';
        }
        catch(Exception $e) {
            return 'Неизвестная ошибка при подтверждении мыла. Временная заглушка.';
        }

    }

    public function resetForget(Request $request){
        $messages = $this->pass_service->resetForget($request);
        if(!empty($messages)) {
            return redirect('/reset/'.$request->token)->withErrors($messages)->withInput($request->toArray());
        }
        return  redirect ('/webmaster');
    }

    public function changePasswordForm(){

        return view('webmaster/profileChangePassword');
    }


}
