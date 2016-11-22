<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\Analysis;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\AnalysisRepositoryInterface;
use DB;
use Exception;


class AnalysisRepository extends Repository implements AnalysisRepositoryInterface
{
    function model()
    {
        return 'App\Models\Analysis';
    }

    public function getInpatientAnalyzesWithDoctorsSortedByDateDESC($inpatient_id)
    {
        try {
            $data = DB::table('analyzes')
                ->where('analyzes.inpatient_id', $inpatient_id)
                ->join('health_workers as doctor_who_appointed', 'analyzes.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->leftJoin('health_workers as doctor_who_performed', 'analyzes.doctor_who_performed', '=', 'doctor_who_performed.id')
                ->select(
                    'analyzes.id as analyses_id',
                    'appointment_date',
                    'ready_date',
                    'analysis_name',
                    'analysis_description',
                    'result_description',
                    'paths_to_files',
                    'doctor_who_appointed.fio as doctor_fio_who_appointed',
                    'doctor_who_performed.fio as doctor_fio_who_performed'
                )
                ->orderBy('analyzes.appointment_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }

    public function getInpatientAnalysesWithDoctor($analyses_id)
    {
        try {
            $data = DB::table('analyzes')
                ->where('analyzes.id', $analyses_id)
                ->join('health_workers as doctor_who_appointed', 'analyzes.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->leftJoin('health_workers as doctor_who_performed', 'analyzes.doctor_who_performed', '=', 'doctor_who_performed.id')
                ->select('appointment_date',
                    'ready_date',
                    'analysis_name',
                    'analysis_description',
                    'result_description',
                    'paths_to_files',
                    'doctor_who_appointed.fio as doctor_fio_who_appointed',
                    'doctor_who_performed.fio as doctor_fio_who_performed'
                )
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }

    public function getALLNotReadyAnalyzesWithDoctorsSortedByDateDESC()
    {
        try {
            $data = DB::table('analyzes')
                ->whereNull('analyzes.ready_date')
                ->join('inpatients', 'analyzes.inpatient_id', '=', 'inpatients.id')
                ->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id')
                ->join('health_workers as doctor_who_appointed', 'analyzes.doctor_who_appointed', '=', 'doctor_who_appointed.id')
                ->select([
                        'inpatients.id as inpatient_id',
                        'received_patients.fio as patient_fio',
                        'analysis_name',
                        'analysis_description',
                        'doctor_who_appointed.fio as doctor_fio_who_appointed']
                )
                ->orderBy('analyzes.appointment_date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}