<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use DB;
use Exception;


class HealthWorkerRepository extends Repository implements HealthWorkerRepositoryInterface
{
    function model()
    {
        return 'App\Models\HealthWorker';
    }
}