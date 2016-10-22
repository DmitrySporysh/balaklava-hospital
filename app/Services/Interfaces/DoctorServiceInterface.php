<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface DoctorServiceInterface
{
    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size);

    public function addNewInspectionProtocolWithPatient(Request $request);

}