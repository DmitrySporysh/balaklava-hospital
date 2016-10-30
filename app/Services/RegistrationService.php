<?php


namespace App\Services;
use App\Exceptions\DALException;
use App\Exceptions\RegistrationServiceException;
use App\Services\Interfaces\RegistrationServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Auth;
use App\Common\Enums\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Mail;
use Hash;


class RegistrationService implements RegistrationServiceInterface
{
    private $user_repo;
    private $validator;

    public function __construct(UserRepositoryInterface $user_repo)

    {
        $this->user_repo = $user_repo;
    }

    public function registerConfirmUser(Request $request)
    {
        try {
            $messages = $this->validateRegisterConfirmUserInput($request);
            if(!empty($messages)) {
                return $messages;
            }
            $email_exists = $this->checkIfUserEmailExists($request->email);

            if ($email_exists) {
                return ['other' => 'Пользователь с данным email уже существует'];
            }
            $token = $this->generateToken();
            $this->createConfirmUser($request, $token);
            $this->sendEmail($token);

            return ['other' => 'token: '.$token];//здесь должно быть сообщение об успешной отправке мыла, но пусть пока токен будет
        }
        catch(Exception $e) {
            $message = 'Unique link sending failed';
            throw new RegistrationServiceException($message,0,$e);
        }


    }


    public function register(Request $request){
        try {
            $messages = $this->validateRegisterInput($request);

            if(!empty($messages)) {
                return $messages;
            }
            
            $data = $this->getConvertedUserData($request);

            $this->user_repo->createUserAndDeleteConfirmUserTransaction($data,$request->token);
            $remember_me = false;
            Auth::attempt(['email' => $data['email'], 'password' => $request->password], $remember_me);

            return;
        }
        catch(Exception $e) {
            $message = 'Registration failed';
            throw new RegistrationServiceException($message,0,$e);
        }
    }


    private  function validateRegisterConfirmUserInput(Request $request)
    {
        $messages=array(
            'email.required'=>'Поле E-mail должно быть заполнено',
            'email.email'=>'E-mail должен быть настоящим адресом',
            'email.max:255'=>'E-mail должен содержать до 255 символов'
        );
        try {
            $this->validator = Validator::make($request->all(), ['email' => 'required|email|max:255'], $messages);
            if($this->validator->fails())
            {
                return $this->validator->messages();
            }
        }
        catch(Exception $e){
            $message = 'Validation error';
            throw new RegistrationServiceException($message,0,$e);
        }
    }
    private  function generateToken()
    {
        $token = str_random(32);
        return $token;
    }
    private  function checkIfUserEmailExists($email)
    {
        try {


            if ($this->user_repo->findBy('email', $email) != null) {

                return true;
            }
            return false;
        }
        catch(DALException $e){
            $message = 'Error while Email Checking (DAL Error)';
            throw new RegistrationServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while Email Checking (Unknown Error)';
            throw new RegistrationServiceException($message,0,$e);
        }
    }
    private  function sendEmail($token)
    {
        try {
            Mail::raw('my-target.pro/confirm/' . $token, function ($message) {
                $message->from("mytargetmy@gmail.com", "MyTarget");
                $message->subject("Подтверждение адреса");
                $message->to(Input::get('email'));
            });
        }
        catch(Exception $e){
            $message =  'Error mail sending in RegistrationService';
            throw new RegistrationServiceException($message,0,$e);
        }
    }
    private  function createConfirmUser(Request $request,$token)
    {
        try {
            $email = $request->email;
            $confirm_user = $this->confirm_user_repo->findBy('email', $email);
            if ($confirm_user == null) {
                $this->confirm_user_repo->create([
                    'email' => $email,
                    'token' => $token
                ]);
            } else {
                $this->confirm_user_repo->update(['token' => $token], $confirm_user['id']);
            }
        }
        catch(DALException $e){
            $message = 'Error while creating ConfirmUser(DAL Error)';
            throw new RegistrationServiceException($message,0,$e);
        }
        catch(Exception $e) {
            $message = 'Error while creating ConfirmUser(Unknown Error)';
            throw new RegistrationServiceException($message,0,$e);
        }

    }

    private function getConvertedUserData(Request $request)
    {

        $role = UserRole::getNumberByValue($request->post);

        if($role && ($role >=0 && $role<=3)){
            $role = UserRole::getValueByNumber($role);
        }

        $data = [
            'fio' => $request->fio,
            'login'  => $request->login,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_qiwi' => $request->qiwi,
            'role' => strval($role),
            'balance' => '0',
            'frozen_balance' => '0',
        ];

        return $data;
    }



    private function getFormErrorMessages()
    {
        $messages=array(
            'fio.required'=>'Поле "ФИО" должно быть заполнено',
            'fio.min:8'=>'Поле "ФИО" должно быть не меньше 8 символов',
            'fio.max:16'=>'Поле "ФИО" должно быть не больше 80 символов',
            'fio.alpha'=>'Фамилия должна содержать только буквы',

            'login.required'=>'Поле "Логин" должно быть заполнено',
            'login.min:2'=>'Поле "Логин" должно быть не меньше 2 символов',
            'login.max:16'=>'Логин должен быть не больше 16 символов',
            'login.unique:users'=>'Такой логин уже занят. Придумайте другой',

            'email.required'=>'Поле "Email" должно быть заполнено',
            'email.email'=>'Поле "Email" должно быть настоящей электронной почтой',
            'email.unique:users'=>'Пользователь с данной электронной почтой уже зарегистрированн',

            'password.required'=>'Поле "Пароль" должно быть заполнено',
            'password.between'=>'Пароль должен содержать от 4 до 16 символов',

            'passwordAgain.required'=>'Поле "Повторите пароль" должно быть заполнено',
            'passwordAgain.same:password'=>'Пароль должен совпадать',


        );
        return $messages;
    }
    private function validateRegisterInput(Request $request)
    {
        $messages = $this->getFormErrorMessages();
        try {
            $this->validator = Validator::make($request->all(), [
                'fio' => 'required|min:8|max:80',
                'login' => 'required|min:2|max:16|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|between:4,16|confirmed',
                'birth_date' => 'required|date',

            ], $messages);
            if($this->validator->fails())
            {
                return $this->validator->messages();
            }
        }
        catch(Exception $e){
            $message = 'Validation error';
            throw new RegistrationServiceException($message,0,$e);
        }
    }
    private  function checkIfLoginExists($login)
    {
        try {
            if ($this->user_repo->findBy('login', $login) != null) {
                return true;
            }
            return false;
        }
        catch(DALException $e){
            $message = 'Error while Login Checking (DAL Error)';
            throw new RegistrationServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while Login Checking (Unknown Error)';
            throw new RegistrationServiceException($message,0,$e);
        }
    }
}