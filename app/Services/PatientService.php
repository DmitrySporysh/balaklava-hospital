<?php
namespace App\Services;

use App\Exceptions\PatientServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\PatientServiceInterface;
use \Exception;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Barryvdh\Debugbar\Facade;
use Debugbar;

class PatientService implements PatientServiceInterface
{
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;
    private $doctor_repo;


    public function  __construct(PatientRepositoryInterface $patient_repo,
                                 InpatientRepositoryInterface $inpatient_repo,
                                 ReceivedPatientRepositoryInterface $received_patient_repo,
                                 HealthWorkerRepositoryInterface $doctor_repo

    ){
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
    }


    public function getReceivedPatientFullInfo($received_patient_id)
    {
        try {
            $columns = [
                'received_patients.id as received_patient_id',
                'patients.id as patient_id',
                'fio',
                'sex',
                'work_place',
                'birth_date',
                'marital_status',
                'residential_address',
                'registration_address',
                'phone',
                'received_date',
                'received_type',
                'insurance_number',
                'complaints'
            ];

            $data =  $this->received_patient_repo->getReceivedPatientWithPatientInfo($received_patient_id, $columns);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw received_patient request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw received_patient request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

    public function getInpatientWithGeneralInfo($inpatient_id)
    {
        try {
            $columns = [
                'fio',
                'birth_date',
                'residential_address',
                'registration_address',
                'marital_status',
                'start_date',
                'diagnosis',
                'insurance_number',
                'blood_type'
            ];

            $data =  $this->inpatient_repo->getInpatientInfoWithReceivedPatientInfoAndPatientInfo($inpatient_id, $columns);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

    private function checkInpatientExists($inpatient_id)
    {
        try {
            $data = $this->inpatient_repo->findBy('id', $inpatient_id, '=', ['id']);
            return $data['id'];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientInspectionProtocolInfo($inpatient_id)
    {
        try {
            $received_patient_id = $this->checkInpatientExists($inpatient_id);
            if(!$received_patient_id)
                return 'Inpatient not found';
            $data =  $this->received_patient_repo->getReceivedPatientInspectionProtocolInfo($received_patient_id);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size)
    {
        try {
            $data =  $this->received_patient_repo->getAwaitingPrimaryInspectionReceivedPatientsSortByDatetimeAsc($page_size);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw received_patient request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw received_patient request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

}