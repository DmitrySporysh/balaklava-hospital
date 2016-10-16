<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\Patient;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Exception;


class PatientRepository extends Repository implements PatientRepositoryInterface
{
    function model()
    {
        return 'App\Models\Patient';
    }
/*
    public function getPatientWithTableInfo($patient_id)
    {
        try {
            $data = Patient::where('patients.id', $patient_id)
                    ->join('district_doctors', 'patients.district_doctor_id', '=', 'district_doctors.id')
                    ->join('health_workers as attending_doctors', 'patients.attending_doctor_id', '=', 'attending_doctors.id')
                    ->join('hospital_departments', 'patients.hospital_department_id', '=', 'hospital_departments.id')
                    ->join('chambers', 'patients.chamber_id', '=', 'chambers.id')
                    ->select('patients.fio as patient_fio',
                        'patients.sex as patient_sex',
                        'patients.birth_date as patient_birth_date',
                        'patients.receipt_date',
                        'patients.initial_inspection',
                        'patients.preliminary_diagnosis',
                        'patients.confirmed_diagnosis',
                        'attending_doctors.fio as attending_doctor_fio',
                        'district_doctors.fio as district_doctor_fio',
                        'hospital_departments.department_name',
                        'chambers.number as chamber_number',
                        'chambers.floor as chamber_floor')
                    ->get();
            if ($data == null) {
                return array();
            }
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }

        if ($data != null) return $data;

        return array();
    }

    public function getPatientsWithTableInfo_Paginate($page_size)
    {
        try {
            $data = Patient::
            join('district_doctors', 'patients.district_doctor_id', '=', 'district_doctors.id')
                ->join('health_workers as attending_doctors', 'patients.attending_doctor_id', '=', 'attending_doctors.id')
                ->join('hospital_departments', 'patients.hospital_department_id', '=', 'hospital_departments.id')
                ->join('chambers', 'patients.chamber_id', '=', 'chambers.id')
                ->select('patients.fio as patient_fio',
                    'patients.sex as patient_sex',
                    'patients.birth_date as patient_birth_date',
                    'patients.receipt_date',
                    'patients.initial_inspection',
                    'patients.preliminary_diagnosis',
                    'patients.confirmed_diagnosis',
                    'attending_doctors.fio as attending_doctor_fio',
                    'district_doctors.fio as district_doctor_fio',
                    'hospital_departments.department_name',
                    'chambers.number as chamber_number',
                    'chambers.floor as chamber_floor')
                ->paginate($page_size);
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        /*if($banner_requests !=null) {
            for ($i = 0; $i < count($banner_requests); $i++) {
                $banner_requests[$i] = (array)$banner_requests[$i];
            }
            return $banner_requests;
        }*/
       /* if ($data != null) return $data;
        return array();
    }
*/
}