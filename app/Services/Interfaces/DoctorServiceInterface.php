<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface DoctorServiceInterface
{
    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size);

    public function getAllNotReadyOperations();

    public function addOperationResult($requestData, $doctor_id);

    public function addNewInspectionProtocol($requestData, $doctor_id);

    public function addNewInpatientAnalysis($requestData, $doctor_id);

    public function addNewInpatientProcedure($requestData, $doctor_id);

    public function addNewInpatientInspection($requestData, $doctor_id);

    public function addNewInpatientOperation($requestData, $doctor_id);

    public function addNewInpatientMedicalAppointment($requestData, $doctor_id);

}