<?php


namespace App\Repositories;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\PasswordResetRepositoryInterface;

class PasswordResetRepository extends Repository implements PasswordResetRepositoryInterface
{
    function model()
    {
        return 'App\Models\PasswordReset';
    }

}