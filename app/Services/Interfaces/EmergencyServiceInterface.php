<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface EmergencyServiceInterface
{

    public function getAllReceivedPatientsSortByDateDesc($page_size);

    public function addNewPatient(Request $request);

    public function checkPatientExists($insurance_number);


    public function ediPatient(Request $request, $patient_id);

    public function deletePatient($patient_id);


}