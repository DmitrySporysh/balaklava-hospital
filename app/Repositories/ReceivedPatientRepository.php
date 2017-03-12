<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Filtration\PatientFilters;
use App\Models\InspectionProtocol;
use App\Models\Patient;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use DB;
use Exception;

class ReceivedPatientRepository extends Repository implements ReceivedPatientRepositoryInterface
{
    function model()
    {
        return 'App\Models\ReceivedPatient';
    }


    public function getReceivedPatientsWithPatientInfoSortByDateDesc_Paginate($per_page)
    {
        try {
            $data = DB::table('received_patients')
                ->join('patients', 'received_patients.patient_id', '=', 'patients.id')
                ->select([
                    'fio',
                    'phone',
                    'received_date',
                    'received_type',
                    'insurance_number'])
                ->orderBy('received_patients.received_date', 'DESC')
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

    public function getAwaitingPrimaryInspectionReceivedPatientsSortByDatetimeAsc($per_page)
    {
        try {
            $data = DB::table('received_patients')
                ->whereNull('received_patients.inspection_protocol_id')
                ->join('patients', 'received_patients.patient_id', '=', 'patients.id')
                ->select([
                    'received_patients.id',
                    'fio',
                    'sex',
                    'received_date',
                    'insurance_number'])
                ->orderBy('received_patients.received_date', 'ASC')
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

    public function getReceivedPatientWithPatientInfo($received_patient_id, $columns)
    {
        try {
            $data = DB::table('received_patients')
                ->where('received_patients.id', '=', $received_patient_id)
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

    public function getAllPatientsSortedAndFiltered($page_size, $columns, $filters = null)
    {
        try {
            $builder = DB::table('received_patients')
                ->whereNull('inpatients.deleted_at') //TODO
                ->join('patients', 'received_patients.patient_id', '=', 'patients.id')
                ->leftJoin('inpatients', 'inpatients.received_patient_id', '=', 'received_patients.id');

            $query = (new PatientFilters($filters))->apply($builder);

            $data = $query
                ->select($columns)
                ->paginate($page_size);

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

    public function getReceivedPatientInspectionProtocolInfo($received_patient_id)
    {
        $columns = [
            'duty_doctor_id', 'date', 'from_anamnesis', 'in_anamnesis', 'insurance_anamnesis',
            'allergoanamnez', 'condition', 'consciousness', 'body_type', 'food', 'skin', 'turgor', 'pupils',
            'tongue', 'auscultation', 'auscultation_extended', 'percussion_sound', 'heart_tones', 'heart_rhythm',
            'heart_rhythm_extended', 'respiratory_movements_frequency_ChDD', 'heart_rate_ChSS', 'heart_boundaries',
            'heart_boundaries_extended', 'muscle_tone', 'muscle_tone_extended', 'joint_motion', 'stomach_density',
            'stomach_pain', 'stomach_extended', 'in_romberg_position', 'gait', 'gait_extended', 'stools',
            'stools_extended', 'stools_consistency',
            'complaints'
        ];

        try {
            $data = DB::table('received_patients')
                ->where('received_patients.id', '=', $received_patient_id)
                ->join('inspections_protocols', 'received_patients.inspection_protocol_id', '=', 'inspections_protocols.id')
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

    public function createNewPatientAndReceivedPatient($patientInfo, $receivedPatientInfo)
    {
        try {
            DB::transaction(function () use ($patientInfo, $receivedPatientInfo) {
                $createdElement = Patient::create($patientInfo);
                $receivedPatientInfo['patient_id'] = $createdElement['id'];
                $this->create($receivedPatientInfo);
            });

        } catch
        (Exception $e) {
            $message = 'Error while creating element using ' . $this->model() . "\n" . $e->getMessage();
            throw new DALException($message, 0, $e);
        }
    }

    public function addNewInspectionProtocol($inspection_protocol_data, $received_patient_id)
    {
        try {
            DB::transaction(function () use ($inspection_protocol_data, $received_patient_id) {
                $createdElement = InspectionProtocol::create($inspection_protocol_data);
                $this->update(['inspection_protocol_id' => $createdElement['id']], $received_patient_id);
            });

        } catch
        (Exception $e) {
            $message = 'Error while finding element using ' . $this->model() . "\n" . $e->getMessage();
            throw new DALException($message, 0, $e);
        }
    }
}