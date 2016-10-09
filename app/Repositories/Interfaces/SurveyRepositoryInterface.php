<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface SurveyRepositoryInterface extends RepositoryInterface
{
    public function getPatientSurveysWithDoctors($patient_id, $per_page);

}