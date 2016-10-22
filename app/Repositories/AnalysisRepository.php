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
            $data = Analysis::where('analyzes.inpatient_id', $inpatient_id)
                ->join('health_workers as doctors', 'analyzes.doctor_id', '=', 'doctors.id')
                ->select('appointment_date',
                    'ready_date',
                    'status',
                    'analysis_name',
                    'analysis_description',
                    'result_description',
                    'paths_to_files',
                    'doctors.fio as doctor_fio'
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