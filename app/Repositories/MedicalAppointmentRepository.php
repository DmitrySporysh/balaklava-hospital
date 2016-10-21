<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\MedicalAppointment;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\MedicalAppointmentRepositoryInterface;
use Exception;


class MedicalAppointmentRepository extends Repository implements MedicalAppointmentRepositoryInterface
{
    function model()
    {
        return 'App\Models\MedicalAppointment';
    }


    public function getInpatientMedicalAppointmentsWithDoctors($inpatient_id)
    {
        try {
            $data = MedicalAppointment::where('medical_appointments.patient_id',$inpatient_id)
                ->join('health_workers as doctors', 'medical_appointments.doctor_id', '=', 'doctors.id')
                ->select(
                    'treatments.date',
                    'medical_appointments.description',
                    'doctors.fio as doctor_fio')
                ->orderBy('medical_appointments.date','DESC')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }
        if ($data != null) return $data;
        return array();
    }
}