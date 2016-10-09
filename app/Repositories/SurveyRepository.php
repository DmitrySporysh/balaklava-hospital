<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\Survey;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\SurveyRepositoryInterface;
use Exception;


class SurveyRepository extends Repository implements SurveyRepositoryInterface
{
    function model()
    {
        return 'App\Models\Survey';
    }

    public function getPatientSurveysWithDoctors($patient_id, $per_page)
    {
        try {
            $data = Survey::where('surveys.patient_id',$patient_id)
                ->join('health_workers as doctors', 'surveys.doctor_id', '=', 'doctors.id')
                ->select('surveys.survey_name',
                    'surveys.survey_date',
                    'surveys.status',
                    'surveys.result_text',
                    'surveys.result_file',
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