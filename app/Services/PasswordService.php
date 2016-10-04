<?php


namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface PasswordServiceInterface
{
    public function reset(Request $request); // Смена в редактировании профиля

    public function forget(Request $request); // Нажал забыл пароль

    public function checkIfForgetPasswordExist($token); // Нажал на ссылку в письме

    public function resetForget(Request $request); // Смена пароля когда забыл
}