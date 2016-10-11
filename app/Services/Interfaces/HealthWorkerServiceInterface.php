<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface HealthWorkerServiceInterface
{

    public function getAllPatients($page_size);

    public function getPatietnFullInfo($patient_id);

    public function addNewPatient(Request $request);

    public function ediPatient(Request $request, $patient_id);

    public function deletePatient($patient_id);

    public function getAllPatientsFio();

    public function testFunc();
}