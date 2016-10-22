<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface NurseServiceInterface
{
    public function getAllDepartmentsWithDepartmentChiefFio();

    public function getDepartmentChambers($department_id);

    public function getChamberWithPatients($chamber_id);
}