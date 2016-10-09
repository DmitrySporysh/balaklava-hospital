<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\DistrictDoctor;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\DistrictDoctorRepositoryInterface;
use Exception;


class DistrictDoctorRepository extends Repository implements DistrictDoctorRepositoryInterface
{
    function model()
    {
        return 'App\Models\DistrictDoctor';
    }

    public function getDistrictDoctorsWithPatients($id){

        try {
            $data = DistrictDoctor::where('id', $id)
                ->with(['patients'
                ])->get();
            ;
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