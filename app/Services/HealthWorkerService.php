<?php
namespace App\Services;

use App\Exceptions\HealthWorkerServiceException;
use App\Exceptions\DALException;
use \Exception;
use App\Services\Interfaces\HealthWorkerServiceInterface;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;



class HealthWorkerService implements HealthWorkerServiceInterface
{
    private $user_repo;
    private $patient_repo;


    public function  __construct(UserRepositoryInterface $user_repo,
                                 PatientRepositoryInterface $patient_repo){
        dd('kokoko2');
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
    }


    public function getAllPatients($page_size)
    {
        try {
            $data =  $this->patient_repo->paginate($page_size);
            return $this->arrayToJson($data);
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw money request(DAL Error)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw money request(UnknownError)';
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

    private function arrayToJson($data){
        for($i = 0; $i<count($data);$i++) {
            $data[$i] =  $data[$i]->toJson();
        }
        return $data;
    }
}