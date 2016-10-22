<?php


namespace App\Services\Interfaces;

use Illuminate\Http\Request;


interface PatientServiceInterface
{
    public function getReceivedPatientFullInfo($received_patient_id);

    public function getInpatientWithGeneralInfo($inpatient_id);

    public function getInpatientInspectionProtocolInfo($inpatient_id);

    public function getInpatientMedicalAppointments($inpatient_id);

    public function getInpatientInspections($inpatient_id);

    public function getInpatientAnalyzes($inpatient_id);

    public function getInpatientDressings($inpatient_id);

    public function getInpatientOperations($inpatient_id);

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size);
}