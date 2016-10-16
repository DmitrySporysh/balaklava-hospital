<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\Chamber;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\ChamberRepositoryInterface;
use Exception;


class ChamberRepository extends Repository implements ChamberRepositoryInterface
{
    function model()
    {
        return 'App\Models\Chamber';
    }

    public function getChambersWithDepartments($perPage){

        try {
            $data = $this->model->with(['hospital_department'])->paginate($perPage);
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
/*
    public function getChamberWithDepartmentAndPatients($chamber_id){

        try {
            $data = $this->model
                ->where('id', $chamber_id)
                ->with(['hospital_department', 'patients'])->get();
            if ($data == null) {
                return array();
            }
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }

        if($data!=null) return $data;

        return array();
    }*/

    public function getNotEmptyChambersWithDepartments($perPage){

        try {
            $data = $this->model->where('beds_occupied_count', '>', 0)->with(['hospital_department'])->paginate($perPage);
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

    public function getNotEmptyChambersByDepartmentNum($department_id, $columns){
        try {
            $data = $this->model->where('hospital_department_id', $department_id)
                ->where('beds_occupied_count', '>', 0)
                ->get($columns);
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