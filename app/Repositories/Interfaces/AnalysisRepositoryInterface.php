<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface AnalysisRepositoryInterface extends RepositoryInterface
{
    public function getInpatientAnalyzesWithDoctorsSortedByDateDESC($inpatient_id);
}