<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface ProcedureRepositoryInterface extends RepositoryInterface
{
    public function getInpatientProceduresWithDoctorsSortedByDateDESC($inpatient_id);

    public function getInpatientProcedureWithDoctor($procedure_id);
}
