<?php


namespace App\Services\Interfaces;

use Illuminate\Http\Request;


interface PatientServiceInterface
{
    public function getReceivedPatientFullInfo($received_patient_id);

    public function getInpatientWithGeneralInfo($inpatient_id);

    public function getInpatientInspectionProtocolInfo($inpatient_id);

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size);
}