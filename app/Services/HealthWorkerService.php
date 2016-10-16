<?php
namespace App\Services;

use App\Exceptions\HealthWorkerServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use \Exception;
use App\Services\Interfaces\HealthWorkerServiceInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\DistrictDoctorRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;




class HealthWorkerService implements HealthWorkerServiceInterface
{
    private $user_repo;
    private $patient_repo;
    private $ipatient_repo;
    private $received_patient_repo;


    public function  __construct(UserRepositoryInterface $user_repo,
                                 PatientRepositoryInterface $patient_repo,
                                 InpatientRepositoryInterface $inpatient_repo,
                                 ReceivedPatientRepositoryInterface $received_patient_repo

    ){
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
    }


    public function getAllReceivedPatientsSortByDateDesc($page_size)
    {
        try {
            $data =  $this->received_patient_repo->getReceivedPatientsSortByDateDesc_Paginate($page_size,['received_date', 'fio']);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw patient request(DAL Error)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw patient request(UnknownError)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
    }
    

    public function addNewPatient(Request $request)
    {
        // TODO: Implement addNewPatient() method.
    }

    public function ediPatient(Request $request, $patient_id)
    {
        // TODO: Implement ediPatient() method.
    }

    public function deletePatient($patient_id)
    {
        // TODO: Implement deletePatient() method.
    }
}