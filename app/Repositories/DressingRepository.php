<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\DressingRepositoryInterface;


class DressingRepository extends Repository implements DressingRepositoryInterface
{
    function model()
    {
        return 'App\Models\Dressing';
    }
}