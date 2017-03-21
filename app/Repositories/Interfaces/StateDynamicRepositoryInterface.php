<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface StateDynamicRepositoryInterface extends RepositoryInterface
{
    public function getInpatientStatesDynamicsWithDoctorsSortedByDateDESC($inpatient_id);
}