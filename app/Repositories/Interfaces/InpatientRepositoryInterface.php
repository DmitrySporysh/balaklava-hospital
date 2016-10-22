<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface InpatientRepositoryInterface extends RepositoryInterface
{
    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $per_page);

    public function getInpatientInfoWithReceivedPatientInfoAndPatientInfo($inpatient_id, $columns);

    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page);

}