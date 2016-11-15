<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface EmergencyServiceInterface
{
    public function getAllReceivedPatientsSortByDateDesc($page_size);

    public function addNewPatient(Request $request, $registration_nurse_id);

    public function ediPatient(Request $request, $patient_id);
}