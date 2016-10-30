<?php


namespace App\Services;
use App\Exceptions\AuthServiceException;
use App\Exceptions\DALException;
use App\Services\Interfaces\AuthorizationServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ConfirmUserRepositoryInterface;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Mail;
use Hash;


class AuthorizationService implements AuthorizationServiceInterface
{
    private $user_repo;
    private $validator;

    public function __construct(UserRepositoryInterface $user_repo)
    {
        $this->user_repo = $user_repo;
    }

    public function login(Request $request){
        try {
            $messages = $this->validateLoginInput($request);
            if(!empty($messages)) {
                return $messages;
            }
            $remember = $this->checkRememberMe($request);
            if (Auth::attempt(['email' => $request->emailLogin, 'password' => $request->password], $remember)) {
                return;
            }
            return ['other' => 'Такого пользователя не существует.'];
        }
        catch(Exception $e) {
            $message = 'Login error';
            throw new AuthServiceException($message,0,$e);
        }
    }


    private function validateLoginInput(Request $request)
    {
        $messages=array(
            'password.between'=>'Пароль должен содержать от 4 до 16 символов',
            'password.required'=>'Поле пароль должно быть заполнено',
            'emailLogin.required'=>'Поле E-mail должно быть заполнено',
            'emailLogin.email'=>'E-mail должен быть настоящим адресом',
            'emailLogin.max:255'=>'E-mail должен содержать до 255 символов'
        );
        try {
            $this->validator = Validator::make($request->all(), [
                'emailLogin' => 'required|email|max:255',
                'password' => 'required|between:4,16'
            ], $messages);
            if($this->validator->fails())
            {
                return $this->validator->messages();
            }
        }
        catch(Exception $e){
            $message = 'Validation error';
            throw new AuthServiceException($message,0,$e);
        }
    }


    private  function checkRememberMe(Request $request)
    {
        if($request->remember=='on') {
            return true;
        }
        return false;
    }

    public function logout(){
        Auth::logout();
    }

}