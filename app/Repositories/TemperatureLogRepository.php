<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\TemperatureLogRepositoryInterface;
use DB;


class TemperatureLogRepository extends Repository implements TemperatureLogRepositoryInterface
{
    function model()
    {
        return 'App\Models\TemperatureLog';
    }

    public function getInpatientTemperatureLogWithDoctorsSortedByDateDESC($inpatient_id)
    {
        try {
            $data = DB::table('temperature_log')
                ->where('temperature_log.inpatient_id', $inpatient_id)
                ->join('health_workers as doctors', 'temperature_log.doctor_id', '=', 'doctors.id')
                ->select('date',
                    'temperature_value',
                    'doctors.fio as doctor_fio')
                ->orderBy('date', 'DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}