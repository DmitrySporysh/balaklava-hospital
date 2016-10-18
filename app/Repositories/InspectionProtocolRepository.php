<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\InspectionProtocol;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\InspectionProtocolRepositoryInterface;
use Exception;


class InspectionProtocolRepository extends Repository implements InspectionProtocolRepositoryInterface
{
    function model()
    {
        return 'App\Models\InspectionProtocol';
    }
}