<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface DoctorServiceInterface
{
    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size);

    public function addNewInspectionProtocol(Request $request, $doctor_id);

    public function addNewInpatientAnalysis($request, $doctor_id);

    public function addNewInpatientProcedure($request, $doctor_id);

    public function addNewInpatientInspection($request, $doctor_id);

    public function addNewInpatientOperation($request, $doctor_id);

    public function addNewInpatientMedicalAppointment($request, $doctor_id);

}