<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\Inpatient;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use Exception;


class InpatientRepository extends Repository implements InpatientRepositoryInterface
{
    function model()
    {
        return 'App\Models\Inpatient';
    }
}