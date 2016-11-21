<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\Inpatient;
use App\Models\Patient;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use DB;
use Exception;


class InpatientRepository extends Repository implements InpatientRepositoryInterface
{
    function model()
    {
        return 'App\Models\Inpatient';
    }

    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $per_page)
    {
        try {
            $data = DB::table('inpatients')
                ->where('inpatients.attending_doctor_id', $doctor_id)
                ->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id')
                ->join('patients', 'received_patients.patient_id', '=', 'patients.id')
                ->join('chambers', 'inpatients.chamber_id', '=', 'chambers.id')
                ->select([
                    'inpatients.id as inpatient_id',
                    'received_patients.fio',
                    'patients.birth_date',
                    'patients.sex',
                    'chambers.number',
                    'received_patients.phone',
                    'inpatients.start_date',
                    'patients.insurance_number'])
                ->orderBy('inpatients.start_date', 'DESC')
                ->paginate($per_page);
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

    public function getInpatientInfoGeneralInfo($inpatient_id, $columns, $joins)
    {
        try {
            $query = DB::table('inpatients')
                ->where('inpatients.id','=', $inpatient_id);

            foreach ($joins as $join)
            switch ($join) {
                case 'received_patients':
                    $query = $query->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id');
                    break;
                case 'patients':
                    $query = $query->join('patients', 'received_patients.patient_id', '=', 'patients.id');
                    break;
                case 'health_workers':
                    $query = $query->join('health_workers', 'inpatients.attending_doctor_id', '=', 'health_workers.id');
                    break;
                case 'district_doctors':
                    $query = $query->join('district_doctors', 'inpatients.district_doctor_id', '=', 'district_doctors.id');
                    break;
                case 'hospital_departments':
                    $query = $query->join('hospital_departments', 'inpatients.hospital_department_id', '=', 'hospital_departments.id');
                    break;
                case 'chambers':
                    $query = $query->join('chambers', 'inpatients.chamber_id', '=', 'chambers.id');
                    break;
            }

            $data = $query->select($columns)->get();
            if ($data == null) {
                return array();
            }
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model() . $e->getMessage();
            throw new DALException($message, 0, $e);
        }

        if ($data != null) return $data;

        return array();
    }

    public function getInpatientsGeneralInfoByChamberId($chamber_id, $columns)
    {
        try {
            $data = DB::table('inpatients')
                ->where('inpatients.chamber_id','=', $chamber_id)
                ->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id')
                ->join('patients', 'received_patients.patient_id', '=', 'patients.id')
                ->select($columns)
                ->get();
            if ($data == null) {
                return array();
            }
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model() . $e->getMessage();
            throw new DALException($message, 0, $e);
        }

        if ($data != null) return $data;

        return array();
    }

    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page)
    {
        try {
            $data = DB::table('inpatients')
                ->where('inpatients.hospital_department_id', $department_id)
                ->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id')
                ->join('chambers', 'inpatients.chamber_id', '=', 'chambers.id')
                ->join('health_workers', 'inpatients.attending_doctor_id', '=', 'health_workers.id')
                ->select([
                    'inpatients.id as inpatient_id',
                    'received_patients.fio as patient_fio',
                    'chambers.number',
                    'start_date',
                    'diagnosis',
                    'health_workers.fio as doctor_fio'
                ])
                ->orderBy('inpatients.start_date', 'DESC')
                ->paginate($per_page);
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


}