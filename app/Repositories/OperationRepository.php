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
use DB;
use Exception;


class OperationRepository extends Repository implements OperationRepositoryInterface
{
    function model()
    {
        return 'App\Models\Operation';
    }

    public function getInpatientOperationsWithDoctorsSortedByDateDESC($inpatient_id)
    {
        try {
            $data = DB::table('operations')
                ->where('operations.inpatient_id', $inpatient_id)
                ->join('health_workers as doctor_who_appointed', 'operations.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->leftJoin('health_workers as doctor_who_performed', 'operations.doctor_who_performed', '=', 'doctor_who_performed.id')
                ->select(
                    'appointment_date',
                    'operation_date',
                    'operation_name',
                    'operation_description',
                    'preliminary_epicrisis',
                    'result_description',
                    'paths_to_files',
                    'doctor_who_appointed.fio as doctor_fio_who_appointed',
                    'doctor_who_performed.fio as doctor_fio_who_performed'
                )
                ->orderBy('operations.operation_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }

    public function getALLNotReadyOperationsWithDoctorsSortedByDateDESC()
    {
        try {
            $data = DB::table('operations')
                ->whereNull('operations.operation_date')
                ->join('inpatients', 'operations.inpatient_id', '=', 'inpatients.id')
                ->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id')
                ->join('health_workers as doctor_who_appointed', 'operations.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->select([
                        'operations.id as operation_id',
                        'inpatients.id as inpatient_id',
                        'received_patients.fio as patient_fio',
                        'appointment_date',
                        'operation_name',
                        'operation_description',
                        'preliminary_epicrisis',
                        'doctor_who_appointed.fio as doctor_fio_who_appointed']
                )
                ->orderBy('operations.appointment_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}