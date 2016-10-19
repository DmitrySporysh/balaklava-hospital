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
                    'received_patients.id as received_patient_id',
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

    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $per_page)
    {
        try {
            $data = DB::table('inpatients')
                ->where('inpatients.hospital_department_id', $department_id)
                ->join('received_patients', 'inpatients.received_patient_id', '=', 'received_patients.id')
                ->join('patients', 'received_patients.patient_id', '=', 'patients.id')
                ->join('chambers', 'inpatients.chamber_id', '=', 'chambers.id')
                ->select([
                    'inpatients.id',
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


}