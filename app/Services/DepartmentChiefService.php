<?php
namespace App\Services;

use App\Exceptions\DepartmentChiefServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\DepartmentChiefServiceInterface;
use \Exception;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;



class DepartmentChiefService implements DepartmentChiefServiceInterface
{
    private $user_repo;
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;
    private $doctor_repo;


    public function  __construct(UserRepositoryInterface $user_repo,
                                 PatientRepositoryInterface $patient_repo,
                                 InpatientRepositoryInterface $inpatient_repo,
                                 ReceivedPatientRepositoryInterface $received_patient_repo,
                                 HealthWorkerRepositoryInterface $doctor_repo

    ){
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
    }


    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $page_size)
    {
        try {
            $data =  $this->inpatient_repo->getDepartmentAllInpatientsSortByDateDesc($department_id, $page_size);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
    }

    public function getDepartmentAllDoctorsSortByFio($department_id, $page_size)
    {
        try {
            $data =  $this->doctor_repo->getDepartmentAllDoctorsSortByFio($department_id, $page_size);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
    }

}