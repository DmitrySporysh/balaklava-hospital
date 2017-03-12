<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\HospitalRepositoryInterface;


class HospitalRepository extends Repository implements HospitalRepositoryInterface
{
    function model()
    {
        return 'App\Models\Hospital';
    }
}