<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface HealthWorkerServiceInterface
{

    public function getAllReceivedPatientsSortByDateDesc($page_size);



    
    public function addNewPatient(Request $request);

    public function ediPatient(Request $request, $patient_id);

    public function deletePatient($patient_id);


}