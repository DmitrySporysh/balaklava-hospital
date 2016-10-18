<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Exceptions\DALException;
use App\Models\ReceivedPatient;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use DB;
use Exception;
use phpDocumentor\Reflection\Types\Null_;


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

        if($data!=null) return $data;

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

        if($data!=null) return $data;

        return array();
    }
}