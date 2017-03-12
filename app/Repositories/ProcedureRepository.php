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
use App\Repositories\Interfaces\ProcedureRepositoryInterface;
use DB;
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
            $data = DB::table('procedures')
                ->where('procedures.inpatient_id', $inpatient_id)
                ->join('health_workers as doctor_who_appointed', 'procedures.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->leftJoin('health_workers as doctor_who_performed', 'procedures.doctor_who_performed', '=', 'doctor_who_performed.id')
                ->select(
                    'procedures.id as procedure_id',
                    'appointment_date',
                    'ready_date',
                    'procedure_name',
                    'procedure_description',
                    'paths_to_files',
                    'doctor_who_appointed.fio as doctor_fio_who_appointed',
                    'doctor_who_performed.fio as doctor_fio_who_performed'
                )
                ->orderBy('procedures.appointment_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }

    public function getInpatientProcedureWithDoctor($procedure_id)
    {
        try {
            $data = DB::table('procedures')
                ->where('procedures.id', $procedure_id)
                ->join('health_workers as doctor_who_appointed', 'procedures.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->leftJoin('health_workers as doctor_who_performed', 'procedures.doctor_who_performed', '=', 'doctor_who_performed.id')
                ->select('appointment_date',
                    'ready_date',
                    'procedure_name',
                    'procedure_description',
                    'paths_to_files',
                    'doctor_who_appointed.fio as doctor_fio_who_appointed',
                    'doctor_who_performed.fio as doctor_fio_who_performed'
                )
                ->first();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}