<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface MedicalNurseServiceInterface
{
    public function getAllReceivedPatientsSortByDateDesc($page_size);

    public function getAllNotReadyAnalyzes();

    public function addNewPatient($requestData, $registration_nurse_id);

    public function addAnalysisResult($requestData, $registration_nurse_id);
}