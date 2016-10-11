<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\Dressing;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\DressingRepositoryInterface;
use Exception;


class DressingRepository extends Repository implements DressingRepositoryInterface
{
    function model()
    {
        return 'App\Models\Dressing';
    }

    public function getPatientDressingsWithDoctors($patient_id)
    {
        try {
            $data = Dressing::where('dressings.patient_id',$patient_id)
                ->join('health_workers as doctors', 'dressings.doctor_id', '=', 'doctors.id')
                ->select('dressings.dressing_date',
                    'dressings.dressing_name',
                    'doctors.fio as doctor_fio')
                ->orderBy('dressings.dressing_date','DESC')
                ->get()
            ;
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}