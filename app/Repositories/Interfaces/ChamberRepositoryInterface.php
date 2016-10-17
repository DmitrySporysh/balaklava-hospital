<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface ChamberRepositoryInterface extends RepositoryInterface
{
    public function getChambersWithDepartments($page_size);

    public function getNotEmptyChambersWithDepartments($perPage);

    public function getChamberWithDepartmentAndPatients($chamber_id);

    public function getNotEmptyChambersByDepartmentNum($department_id, $columns);
}