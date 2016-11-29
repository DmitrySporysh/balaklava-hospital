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
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\DischargeRepositoryInterface;
use DB;
use Exception;


class DischargeRepository extends Repository implements DischargeRepositoryInterface
{
    function model()
    {
        return 'App\Models\Discharge';
    }

    public function addDischargeAndDeleteInpatient($dischargeData)
    {
        try {
            DB::transaction(function () use ($dischargeData) {
                $this->create($dischargeData);
                Inpatient::destroy($dischargeData['inpatient_id']);
            });

        } catch
        (Exception $e) {
            $message = 'Error while creating element using ' . $this->model() . "\n" . $e->getMessage();
            throw new DALException($message, 0, $e);
        }
    }
}