<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;

use App\Common\Enums\UserRole;
use App\Exceptions\DALException;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use DB;
use Exception;


class HealthWorkerRepository extends Repository implements HealthWorkerRepositoryInterface
{
    function model()
    {
        return 'App\Models\HealthWorker';
    }

    public function getDepartmentAllDoctorsSortByFio($department_id, $page_size)
    {
        try {
            $data = DB::table('health_workers')
                ->where('post', UserRole::DOCTOR)
                ->where('department_id', $department_id)
                ->select([
                    'id',
                    'fio',
                    'sex',
                    'birth_date'
                ])
                ->orderBy('fio', 'ASC')
                ->paginate($page_size);

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