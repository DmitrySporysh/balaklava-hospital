<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\Procedure;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\ProcedureRepositoryInterface;
use Exception;


class ProcedureRepository extends Repository implements ProcedureRepositoryInterface
{
    function model()
    {
        return 'App\Models\Procedure';
    }

    public function getInpatientProceduresWithDoctorsSortedByDateDESC($inpatient_id)
    {
        try {
            $data = Procedure::where('procedures.inpatient_id', $inpatient_id)
                ->join('health_workers as doctors', 'procedures.doctor_id', '=', 'doctors.id')
                ->select('procedure_date',
                    'procedure_name',
                    'procedure_description',
                    'doctors.fio as doctor_fio')
                ->orderBy('procedures.procedure_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}