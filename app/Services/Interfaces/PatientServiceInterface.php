<?php


namespace App\Services\Interfaces;

use Illuminate\Http\Request;


interface PatientServiceInterface
{
    public function getReceivedPatientFullInfo($received_patient_id);

    public function getInpatientGeneralInfo($inpatient_id);

    public function getInpatientWithGeneralInfoAndAttendingDoctor($inpatient_id);

    public function getInpatientAllInfo($inpatient_id);

    public function getInpatientInspectionProtocolInfo($inpatient_id);

    public function getInpatientMedicalAppointments($inpatient_id);

    public function getInpatientInspections($inpatient_id);

    public function getInpatientAnalyzes($inpatient_id);

    public function getInpatientProcedures($inpatient_id);

    public function getInpatientOperations($inpatient_id);

    public function getInpatientTemperatureLog($inpatient_id);

    public function getPatientsArchive($per_page, Request $request);

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size);
}