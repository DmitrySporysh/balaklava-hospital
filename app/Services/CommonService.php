<?php
namespace App\Services;

use App\Exceptions\CommonServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\HospitalDepartmentRepositoryInterface;
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use App\Services\Interfaces\CommonServiceInterface;
use \Exception;


class CommonService implements CommonServiceInterface
{
    private $departmentRepository;
    private $hospitalRepository;


    public function  __construct(HospitalDepartmentRepositoryInterface $departmentRepository ,
                                 HospitalRepositoryInterface $hospitalRepository

    ){
        $this->departmentRepository = $departmentRepository;
        $this->hospitalRepository = $hospitalRepository;
    }

    public function getAllDepartments()
    {
        try {
            $data =  $this->departmentRepository->all(['id', 'department_name']);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw departments request(DAL Error)';
            throw new CommonServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new CommonServiceException($message,0,$e);
        }
    }

    public function getAllHospitals()
    {
        try {
            $data =  $this->hospitalRepository->all(['id', 'hospital_name']);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw hospitals request(DAL Error)';
            throw new CommonServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw hospitals request(UnknownError)';
            throw new CommonServiceException($message,0,$e);
        }
    }

}