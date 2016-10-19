<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface DoctorServiceInterface
{
    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size);

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size);

    public function getReceivedPatientFullInfo($received_patient_id);

    public function addNewInspectionProtocolWithPatient(Request $request);

}