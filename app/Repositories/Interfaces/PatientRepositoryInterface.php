<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface PatientRepositoryInterface extends RepositoryInterface
{
    public function getPatientFullInfo($patient_id);

    public function getAllPatientsFullInfo($page_size);
}