<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\HospitalDepartment;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\HospitalDepartmentRepositoryInterface;
use Exception;


class HospitalDepartmentRepository extends Repository implements HospitalDepartmentRepositoryInterface
{
    function model()
    {
        return 'App\Models\HospitalDepartment';
    }

    public function getAllDepartmentsWithDepartmentChiefFio()
    {
        try {
            $data = HospitalDepartment::
            join('health_workers as department_chief', 'hospital_departments.department_chief_id', '=', 'department_chief.id')
                ->select('hospital_departments.id',
                    'hospital_departments.department_name',
                    'department_chief.fio as department_chief_fio')
                ->get();
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }

        if ($data != null) return $data;
        return array();
    }
}