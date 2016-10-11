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

    public function getPatientSurveysWithDoctorsAndSurveysType($patient_id)
    {
        try {
            $data = Survey::where('surveys.patient_id',$patient_id)
                ->join('health_workers as doctors', 'surveys.doctor_id', '=', 'doctors.id')
                ->join('surveys_types', 'surveys.survey_type_id', '=', 'surveys_types.id')
                ->select('surveys.survey_name',
                    'surveys.survey_date',
                    'surveys.status',
                    'surveys.result_text',
                    'surveys.result_file',
                    'doctors.fio as doctor_fio',
                    'surveys_types.survey_type_name',
                    'surveys_types.description',
                    'surveys_types.room_number'
                    )
                ->orderBy('surveys.survey_date','DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}