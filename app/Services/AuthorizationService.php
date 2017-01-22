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
            $requestDate = $request->all();
            $messages = $this->validateLoginInput($requestDate);

            if (!empty($messages)) {
                return $messages;
            }

            $remember = $this->checkRememberMe($request);
            if (Auth::attempt(['login' => $requestDate['login'], 'password' => $requestDate['password']], $remember)) {
                $worker = Auth::user()->health_worker;
                $request->session()->put('fio',  $worker->fio);
                $request->session()->put('post',  $worker->post);
                $request->session()->put('health_worker_id', $worker->id);
                return;
            }

            return 'Неверный логин или пароль';

        } catch (Exception $e) {
            $message = 'Login error';
            throw new AuthServiceException($message, 0, $e);
        }
    }


    private function validateLoginInput($requestDate)
    {
        $messages = array(
            'password.required' => 'Поле "Пароль" должно быть заполнено',
            'password.between' => 'Пароль должен содержать от 4 до 16 символов',
            'login.required'=>'Поле "Логин" должно быть заполнено',
            'login.min'=>'Поле "Логин" должно быть не меньше 2 символов',
            'login.max'=>'Логин должен быть не больше 16 символов'
        );
        try {
            $this->validator = Validator::make($requestDate, [
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
    }

    protected function guard()
    {
        return Auth::guard();
    }

}