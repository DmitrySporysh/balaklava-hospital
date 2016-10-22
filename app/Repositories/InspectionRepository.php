<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\Inspection;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\InspectionRepositoryInterface;
use Exception;


class InspectionRepository extends Repository implements InspectionRepositoryInterface
{
    function model()
    {
        return 'App\Models\Inspection';
    }

    public function getInpatientInspectionsWithDoctorsSortedByDateDESC($inpatient_id)
    {
        try {
            $data = Inspection::where('inspections.inpatient_id',$inpatient_id)
                ->join('health_workers as doctors', 'inspections.doctor_id', '=', 'doctors.id')
                ->select('inspection_date',
                    'state_type',
                    'description_extended',
                    'doctors.fio as doctor_fio')
                ->orderBy('inspections.inspection_date','DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}