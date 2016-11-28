<?php


namespace App\Services\Interfaces;


interface MedicalNurseServiceInterface
{
    public function getAllReceivedPatientsSortByDateDesc($page_size);

    public function getAllNotReadyAnalyzes();

    public function addNewPatient($requestData, $registration_nurse_id);

    public function addAnalysisResult( $requestData, $nurse_id);
}