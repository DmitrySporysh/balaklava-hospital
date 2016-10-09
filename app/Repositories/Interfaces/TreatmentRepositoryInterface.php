<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface TreatmentRepositoryInterface extends RepositoryInterface
{
    public function getPatientTreatmentsWithDoctors($patient_id, $per_page);
}