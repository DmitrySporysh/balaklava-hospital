<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface HealthWorkerRepositoryInterface extends RepositoryInterface
{
    public function getDepartmentAllDoctorsSortByFio($department_id, $page_size);
}