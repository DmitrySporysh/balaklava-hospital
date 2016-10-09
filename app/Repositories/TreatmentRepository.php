<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\Treatment;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\TreatmentRepositoryInterface;
use Exception;


class TreatmentRepository extends Repository implements TreatmentRepositoryInterface
{
    function model()
    {
        return 'App\Models\Treatment';
    }

    public function getPatientTreatmentsWithDoctors($patient_id, $per_page)
    {
        try {
            $data = Treatment::where('treatments.patient_id',$patient_id)
                ->join('health_workers as doctors', 'treatments.doctor_id', '=', 'doctors.id')
                ->select('treatments.treatment_name',
                    'treatments.date',
                    'treatments.description',
                    'doctors.fio as doctor_fio')
                ->paginate($per_page);
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}