<?php
namespace App\Services;

use App\Exceptions\PatientServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\AnalysisRepositoryInterface;
use App\Repositories\Interfaces\DressingRepositoryInterface;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\InspectionRepositoryInterface;
use App\Repositories\Interfaces\MedicalAppointmentRepositoryInterface;
use App\Repositories\Interfaces\OperationRepositoryInterface;
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
    private $medical_appointment_repo;
    private $inspection_repo;
    private $analysis_repo;
    private $dressing_repo;
    private $operation_repo;
    private $doctor_repo;


    public function  __construct(PatientRepositoryInterface $patient_repo,
                                 InpatientRepositoryInterface $inpatient_repo,
                                 ReceivedPatientRepositoryInterface $received_patient_repo,
                                 MedicalAppointmentRepositoryInterface $medical_appointment_repo,
                                 InspectionRepositoryInterface $inspection_repo,
                                 AnalysisRepositoryInterface $analysis_repo,
                                 DressingRepositoryInterface $dressing_repo,
                                 OperationRepositoryInterface $operation_repo,
                                 HealthWorkerRepositoryInterface $doctor_repo

    ){
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->medical_appointment_repo = $medical_appointment_repo;
        $this->inspection_repo = $inspection_repo;
        $this->analysis_repo = $analysis_repo;
        $this->dressing_repo = $dressing_repo;
        $this->operation_repo = $operation_repo;
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
                'work_place',
                'start_date',
                'diagnosis',
                'insurance_number',
                'blood_type',
                'sex',
                'phone'
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

    public function getInpatientMedicalAppointments($inpatient_id)
    {
        try {
            $data =  $this->medical_appointment_repo->getInpatientMedicalAppointmentsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw medical appointment request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw medical appointment request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

    public function getInpatientInspections($inpatient_id)
    {
        try {
            $data =  $this->inspection_repo->getInpatientInspectionsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw inspections request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inspections request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

    public function getInpatientAnalyzes($inpatient_id)
    {
        try {
            $data =  $this->analysis_repo->getInpatientAnalyzesWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw analyzes request(DAL Error)';
            throw new PatientServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw analyzes request(UnknownError)';
            throw new PatientServiceException($message,0,$e);
        }
    }

    public function getInpatientDressings($inpatient_id)
    {
        try {
            $data =  $this->dressing_repo->getInpatientDressingsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient dressings request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient dressings request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }


    public function getInpatientOperations($inpatient_id)
    {
        try {
            $data = $this->operation_repo->getInpatientOperationsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient operations request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient operations request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
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