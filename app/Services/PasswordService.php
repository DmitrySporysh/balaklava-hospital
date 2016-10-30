<?php


namespace App\Services;

use App\Exceptions\PasswordServiceException;
use App\Repositories\Interfaces\PasswordResetRepositoryInterface;
use App\Services\Interfaces\PasswordServiceInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;
use Mail;
use Hash;


class PasswordService implements PasswordServiceInterface
{
    private $user_repo;
    private $password_reset_repo;

    private $validator;

    public function __construct(UserRepositoryInterface $user_repo,
                                PasswordResetRepositoryInterface $password_reset_repo)
    {
        $this->user_repo = $user_repo;
        $this->password_reset_repo = $password_reset_repo;
    }

    public function reset(Request $request)
    {
        try {

            $messages = $this->validatePassword($request); // Валидация пароля
            if (!empty($messages)) {
                return $messages;
            }

            if (Hash::check($request->input('oldpassword'), Auth::user()->password)) {

                $password = bcrypt($request->input('password'));
                $this->user_repo->update(['password' => $password], Auth::user()->id);
            }
            else {
                $messages = ['oldpassword' => 'Неверный пароль'];
            }

            return $messages;
        } catch (Exception $e) {
            $message = 'Reset Password failed';
            throw new PasswordServiceException($message, 0, $e);
        }

    }

    public function forget(Request $request)
    {
        try {
            $messages = $this->validateForgetInput($request); // Валидация мыла
            if (!empty($messages)) {
                return $messages;
            }

            $email_exists = $this->checkIfUserEmailExists($request->email); // Если такое мыло существует

            if (!$email_exists) {
                return ['other' => 'Пользователя с данным email не существует'];
            }
            $token = $this->generateToken();
            $this->createPasswordReset($request, $token); // Пишем в таблицу или обновляем таблицу
            $this->sendAcceptEmail($token);

            return ['success' => 'Письмо успешно отправлено.'];
        } catch (Exception $e) {
            $message = 'Unique link sending failed';
            throw new PasswordServiceException($message, 0, $e);
        }
    }

    public function checkIfForgetPasswordExist($token)
    {
        try {
            return $this->password_reset_repo->findBy('token', $token);
        } catch (DALException $e) {
            $message = 'Error while checking ConfirmUser(DAL Error)';
            throw new RegistrationServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while checking ConfirmUser(Unknown Error)';
            throw new RegistrationServiceException($message, 0, $e);
        }
    }

    public function resetForget(Request $request)
    {
        try {

            $reset_password = $this->checkIfForgetPasswordExist($request->token);
            if ($reset_password == null) return ['other' => 'Неверный код верификации.'];

            $messages = $this->validatePassword($request); // Валидация пароля
            if (!empty($messages)) {
                return $messages;
            }

            $user = $this->user_repo->findBy("email", $reset_password['email']);
            $this->user_repo->update(['password' => bcrypt($request->password)], $user['id']);
            $this->password_reset_repo->delete($reset_password['id']);
            Auth::loginUsingId($user['id']);

            return;
        } catch (Exception $e) {
            $message = 'Reset failed';
            throw new PasswordServiceException($message, 0, $e);
        }
    }


    private function validateForgetInput(Request $request)
    {
        $messages = array(
            'email.required' => 'Поле E-mail должно быть заполнено',
            'email.email' => 'E-mail должен быть настоящим адресом',
            'email.max:255' => 'E-mail должен содержать до 255 символов'
        );
        try {
            $this->validator = Validator::make($request->all(), ['email' => 'required|email|max:255'], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Validation error';
            throw new PasswordServiceException($message, 0, $e);
        }
    }

    private function checkIfUserEmailExists($email)
    {
        try {
            if ($this->user_repo->findBy('email', $email) != null) {
                return true;
            }
            return false;
        } catch (DALException $e) {
            $message = 'Error while Email Checking (DAL Error)';
            throw new RegistrationServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while Email Checking (Unknown Error)';
            throw new RegistrationServiceException($message, 0, $e);
        }
    }

    private function generateToken()
    {
        $token = str_random(32);
        return $token;
    }

    private function createPasswordReset(Request $request, $token)
    {
        try {
            $email = $request->email;
            $reset_password = $this->password_reset_repo->findBy('email', $email);
            if ($reset_password == null) {
                $this->password_reset_repo->create([
                    'email' => $email,
                    'token' => $token
                ]);
            } else {
                $this->password_reset_repo->update(['token' => $token], $reset_password['id']);
            }
        } catch (DALException $e) {
            $message = 'Error while creating ConfirmUser(DAL Error)';
            throw new PasswordServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating ConfirmUser(Unknown Error)';
            throw new PasswordServiceException($message, 0, $e);
        }

    }

    private function sendAcceptEmail($token)
    {
        try {
            Mail::raw('mytarget.ru/reset/' . $token, function ($message) {
                $message->from("mytargetmy@gmail.com", "MyTarget");
                $message->subject("Смена пароля");
                $message->to(Input::get('email'));
            });
        } catch (Exception $e) {
            $message = 'Error mail sending in RegistrationService';
            throw new PasswordServiceException($message, 0, $e);
        }
    }

    private function validatePassword(Request $request)
    {
        $messages = $this->getFormErrorMessages();
        try {
            $this->validator = Validator::make($request->all(), [
                'password' => 'required|between:4,16',
                'passwordAgain' => 'required|same:password',
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Validation error';
            throw new PasswordServiceException($message, 0, $e);
        }
    }

    private function getFormErrorMessages()
    {
        $messages=array(
            'password.required'=>'Поле должно быть заполнено',
            'password.between'=>'Пароль должен содержать 4-16 символов',
            'passwordAgain.required'=>'Поле должно быть заполнено',
            'passwordAgain.same'=>'Пароли должены совпадать',
        );
        return $messages;
    }

}