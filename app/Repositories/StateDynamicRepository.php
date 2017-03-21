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
use App\Repositories\Interfaces\StateDynamicRepositoryInterface;
use DB;
use Exception;


class StateDynamicRepository extends Repository implements StateDynamicRepositoryInterface
{
    function model()
    {
        return 'App\Models\StateDynamic';
    }

    public function getInpatientStatesDynamicsWithDoctorsSortedByDateDESC($inpatient_id)
    {
        try {
            $data = DB::table('state_dynamic')
            ->where('state_dynamic.inpatient_id',$inpatient_id)
                ->join('health_workers as doctors', 'state_dynamic.doctor_id', '=', 'doctors.id')
                ->select('date',
                    'description',
                    'appointment',
                    'doctors.fio as doctor_fio')
                ->orderBy('state_dynamic.date','DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}