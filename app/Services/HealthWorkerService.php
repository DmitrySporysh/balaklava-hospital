<?php
namespace App\Services;

use App\Exceptions\HealthWorkerServiceException;
use App\Exceptions\DALException;
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
    private $districtDoctor_repo;


    public function  __construct(UserRepositoryInterface $user_repo,
                                 PatientRepositoryInterface $patient_repo,
                                 DistrictDoctorRepositoryInterface $districtDoctor_repo

    ){
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->districtDoctor_repo = $districtDoctor_repo;
    }


    public function getAllPatients($page_size)
    {
        try {
            $data =  $this->patient_repo->paginate($page_size);
            return $data;
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
    
    public function getAllPatientsFio()
    {
        try {
            $data =  $this->patient_repo->all(array('fio'));
            return $data;
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

    public function getPatietnFullInfo($patient_id)
    {
        try {
            $data =  $this->patient_repo->getPatientFullInfo($patient_id);
            return $data;
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

    public function testFunc()
    {
        try {
            $data =  $this->districtDoctor_repo->getDistrictDoctorsWithPatients(2);
            return $data;
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
        try {
            $data =  $this->patient_repo->create(['fio' => $request->fio, 'sex' => 'male', 'birth_date' => '2010-10-10', 'receipt_date' => '2010-10-10']);
            return $data;
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
            $data[$i] =  $data[$i]->toArray();
        }
        dd($data);
        return $data;
    }
}