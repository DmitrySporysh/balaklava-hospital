<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\AuthServiceException;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

    public function login(Request $request)
    {

        try {
            $errors = $this->auth_service->login($request);

            if (empty($errors)) {
                $post = Auth::user()->health_worker->post;
                return ['success' => true, 'post' => $post];
            } else {
                if (Auth::guest()) {
                    return ['success' => false, 'message' => $errors];
                }
            }
        } catch (AuthServiceException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Неизвестная ошибка логина.'];
        }
    }


    public function logout(Request $request)
    {
        try {
            $this->auth_service->logout($request);
            return ['success' => true];
        } catch (AuthServiceException $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        } catch (Exception $e) {
            return ['success' => false, 'message' => 'Неизвестная ошибка при выходе из системы'];
        }
    }

}
