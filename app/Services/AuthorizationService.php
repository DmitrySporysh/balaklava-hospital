<?php


namespace App\Services;

use App\Services\Interfaces\AuthorizationServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Validator;


class AuthorizationService implements AuthorizationServiceInterface
{

    private $user_repo;
    private $validator;

    public function __construct(UserRepositoryInterface $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    public function login(Request $request)
    {
        try {
            $messages = $this->validateLoginInput($request);

            if (!empty($messages)) {
                return $messages;
            }

            $remember = $this->checkRememberMe($request);
            if (Auth::attempt(['login' => $request->login, 'password' => $request->password], $remember)) {
                $request->session()->put('fio',  Auth::user()->health_worker->fio);
                return;
            }

            return ['other' => 'Такого пользователя не существует.'];
        } catch (Exception $e) {
            $message = 'Login error';
            throw new AuthServiceException($message, 0, $e);
        }
    }


    private function validateLoginInput(Request $request)
    {
        $messages = array(
            'password.required' => 'Поле "Пароль" должно быть заполнено',
            'password.between' => 'Пароль должен содержать от 4 до 16 символов',
            'login.required'=>'Поле "Логин" должно быть заполнено',
            'login.min'=>'Поле "Логин" должно быть не меньше 2 символов',
            'login.max'=>'Логин должен быть не больше 16 символов'
        );
        try {
            $this->validator = Validator::make($request->all(), [
                'login' => 'required|min:2|max:16',
                'password' => 'required|between:4,16'
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Validation error';
            throw new AuthServiceException($message, 0, $e);
        }
    }


    private function checkRememberMe(Request $request)
    {
        if ($request->remember == 'on') {
            return true;
        }
        return false;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }

}