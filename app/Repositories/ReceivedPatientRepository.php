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


class ReceivedPatientRepository extends Repository implements ReceivedPatientRepositoryInterface
{
    function model()
    {
        return 'App\Models\ReceivedPatient';
    }


    public function getReceivedPatientsSortByDateDesc_Paginate($per_page, $columns)
    {
        try {
            $data = DB::table('received_patients')->
                select($columns)
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
}