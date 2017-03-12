<?php
namespace App\Services;

use App\Services\Interfaces\RegistrationServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Common\Enums\UserRole;
use Exception;
use Validator;


class RegistrationService implements RegistrationServiceInterface
{
    private $user_repo;
    private $validator;

    public function __construct(UserRepositoryInterface $user_repo)

    {
        $this->user_repo = $user_repo;
    }

    public function register($request)
    {
        try {
            $requestDate = $request;
            $messages = $this->validateRegisterInput($requestDate);

            if (!empty($messages)) {
                return $messages;
            }

            $data = $this->getConvertedUserData($requestDate);

            $this->user_repo->createUserWithHealthWorker($data['health_worker'], $data['user']);

            //login after registration
            //$remember_me = false;
            //Auth::attempt($data['user'], $remember_me);

            return ['success' => true, 'message' => 'Пользователь ' . $requestDate->login . ' успешно зарегистрирован'];
        } catch (Exception $e) {
            $message = 'Registration failed';
            throw new RegistrationServiceException($message, 0, $e);
        }
    }

    private function getFormErrorMessages()
    {
        $messages = array(
            'fio.required' => 'Поле "ФИО" должно быть заполнено',
            'fio.min' => 'Поле "ФИО" должно быть не меньше 8 символов',
            'fio.max' => 'Поле "ФИО" должно быть не больше 80 символов',
            'fio.alpha' => 'Фамилия должна содержать только буквы',

            'birth_date.required' => 'Поле "Дата рождения" должно быть заполненно',
            'birth_date.date' => 'Дата должна быть введена правильно',

            'login.required' => 'Поле "Логин" должно быть заполнено',
            'login.min' => 'Поле "Логин" должно быть не меньше 2 символов',
            'login.max' => 'Логин должен быть не больше 16 символов',
            'login.unique' => 'Такой логин уже занят. Придумайте другой',

            'email.required' => 'Поле "Email" должно быть заполнено',
            'email.email' => 'Поле "Email" должно быть настоящей электронной почтой',
            'email.unique' => 'Пользователь с данной электронной почтой уже зарегистрированн',

            'password.required' => 'Поле "Пароль" должно быть заполнено',
            'password.between' => 'Пароль должен содержать от 4 до 16 символов',
            'password.confirmed' => 'Пароль должен совпадать',
        );
        return $messages;
    }

    private function validateRegisterInput($requestDate)
    {
        $messages = $this->getFormErrorMessages();
        try {
            $this->validator = Validator::make($requestDate, [
                'fio' => 'required|min:8|max:80',
                'login' => 'required|min:2|max:16|unique:users',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|between:4,16|confirmed',
                'birth_date' => 'required|date',

            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Validation error';
            throw new RegistrationServiceException($message, 0, $e);
        }
    }

    private function generateToken()
    {
        $token = str_random(32);
        return $token;
    }


    private function getConvertedUserData($requestDate)
    {
        $post = UserRole::getNumberByValue($requestDate->post);

        if ($post && ($post >= 0 && $post <= 3)) {
            $post = UserRole::getValueByNumber($post);
        }

        $data['user'] = [
            'login' => $requestDate->login,
            'email' => $requestDate->email,
            'password' => bcrypt($requestDate->password),
            'remember_token' => $this->generateToken()
        ];

        $data['health_worker'] = [
            'fio' => $requestDate->fio,
            'sex' => $requestDate->sex,
            'birth_date' => $requestDate->birth_date,
            'post' => $post,
        ];

        return $data;
    }

}