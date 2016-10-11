<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface NurseServiceInterface
{
    public function getAllDepartments();

    public function getDepartmentChambers($department_id);

    public function getChamberFullInfo($chamber_id);

    public function getPatientWithTableInfo($patient_id);

    public function getPatientDressings($patient_id);

    public function getPatientInspections($patient_id );

    public function getPatientOperations($patient_id);

    public function getPatientSurveys($patient_id);

    public function getPatientTreatments($patient_id);

   
}