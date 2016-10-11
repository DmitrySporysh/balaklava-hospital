<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\Operation;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\OperationRepositoryInterface;
use Exception;


class OperationRepository extends Repository implements OperationRepositoryInterface
{
    function model()
    {
        return 'App\Models\Operation';
    }

    public function getPatientOperationsWithDoctors($patient_id)
    {
        try {
            $data = Operation::where('operations.patient_id', $patient_id)
                ->join('health_workers as doctors', 'operations.doctor_id', '=', 'doctors.id')
                ->select('operations.operation_date',
                    'operations.operation_name',
                    'operations.preliminary_epicrisis',
                    'operations.result',
                    'doctors.fio as doctor_fio')
                ->orderBy('operations.operation_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}