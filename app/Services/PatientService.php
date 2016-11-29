<?php
namespace App\Services;

use App\Exceptions\PatientServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\AnalysisRepositoryInterface;
use App\Repositories\Interfaces\ProcedureRepositoryInterface;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\InspectionRepositoryInterface;
use App\Repositories\Interfaces\MedicalAppointmentRepositoryInterface;
use App\Repositories\Interfaces\OperationRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Repositories\Interfaces\TemperatureLogRepositoryInterface;
use App\Services\Interfaces\FileServiceInterface;
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
    private $procedureRepository;
    private $operation_repo;
    private $doctor_repo;
    private $temperatureLogRepository;
    private $fileService;


    public function __construct(PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo,
                                MedicalAppointmentRepositoryInterface $medical_appointment_repo,
                                InspectionRepositoryInterface $inspection_repo,
                                AnalysisRepositoryInterface $analysis_repo,
                                ProcedureRepositoryInterface $procedureRepository,
                                OperationRepositoryInterface $operation_repo,
                                HealthWorkerRepositoryInterface $doctor_repo,
                                TemperatureLogRepositoryInterface $temperatureLogRepository,
                                FileServiceInterface $fileService


    )
    {
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->medical_appointment_repo = $medical_appointment_repo;
        $this->inspection_repo = $inspection_repo;
        $this->analysis_repo = $analysis_repo;
        $this->procedureRepository = $procedureRepository;
        $this->operation_repo = $operation_repo;
        $this->doctor_repo = $doctor_repo;
        $this->temperatureLogRepository = $temperatureLogRepository;
        $this->fileService = $fileService;
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

            $data = $this->received_patient_repo->getReceivedPatientWithPatientInfo($received_patient_id, $columns);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw received_patient request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw received_patient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getPatientsArchive($per_page, Request $request)
    {
        try {
            $columns = [
                'fio',
                'insurance_number',
                'sex',
                'inpatients.id as inpatient_number'
            ];
            $filters = $request->all();
            if ($filters == null) $filters['sort'] = null; // для сортировки по умолчанию
            else if($filters['sort'] == null) $filters['sort'] = null; // для сортировки по умолчанию
            $data = $this->received_patient_repo->getAllPatientsSortedAndFiltered($per_page, $columns, $filters);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientGeneralInfo($inpatient_id)
    {
        try {
            $columns = [
                'received_patients.fio',
                'patients.birth_date',
                'residential_address',
                'registration_address',
                'marital_status',
                'work_place',
                'start_date',
                'diagnosis',
                'insurance_number',
                'blood_type',
                'patients.sex',
                'phone',
                'health_workers.fio as attending_doctor_fio',
                'chambers.number as chamber_number',
                'hospital_departments.department_name'
            ];
            $data = $this->inpatient_repo->getInpatientInfoGeneralInfo($inpatient_id, $columns,
                ['received_patients', 'patients', 'health_workers', 'hospital_departments', 'chambers']);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)' . $e->getMessage();
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientAllInfo($inpatient_id)
    {
        try {
            $columnsInpatient = [
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
            //general patient info
            $data['inpatient_info'] = $this->inpatient_repo->getInpatientInfoGeneralInfo($inpatient_id, $columnsInpatient,
                ['received_patients', 'patients']);
            //inspection_protocol
            $received_patient_id = $this->getReceivedPatientByInpatient($inpatient_id);
            if (!$received_patient_id)
                return 'Inpatient not found';
            $data['inspection_protocol'] = $this->received_patient_repo->getReceivedPatientInspectionProtocolInfo($received_patient_id);
            //analyzes
            $data['analyzes'] = $this->analysis_repo->getInpatientAnalyzesWithDoctorsSortedByDateDESC($inpatient_id);
            //operations
            $data['operations'] = $this->operation_repo->getInpatientOperationsWithDoctorsSortedByDateDESC($inpatient_id);
            //procedures
            $data['procedures'] = $this->procedureRepository->getInpatientProceduresWithDoctorsSortedByDateDESC($inpatient_id);
            //inspections
            $data['inspections'] = $this->inspection_repo->getInpatientInspectionsWithDoctorsSortedByDateDESC($inpatient_id);
            //medical_appointments
            $data['medical_appointments'] = $this->medical_appointment_repo->getInpatientMedicalAppointmentsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    private function getReceivedPatientByInpatient($inpatient_id)
    {
        try {
            $data = $this->inpatient_repo->findBy('id', $inpatient_id, '=', ['received_patient_id']);
            return $data['received_patient_id'];
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
            $received_patient_id = $this->getReceivedPatientByInpatient($inpatient_id);
            if (!$received_patient_id)
                return ['success' => false, 'error' => 'Inpatient not found'];
            $data = $this->received_patient_repo->getReceivedPatientInspectionProtocolInfo($received_patient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientMedicalAppointments($inpatient_id)
    {
        try {
            $data = $this->medical_appointment_repo->getInpatientMedicalAppointmentsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw medical appointment request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw medical appointment request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientInspections($inpatient_id)
    {
        try {
            $data = $this->inspection_repo->getInpatientInspectionsWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inspections request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inspections request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientAllAnalyzes($inpatient_id)
    {
        try {
            $data = $this->analysis_repo->getInpatientAnalyzesWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw analyzes request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw analyzes request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientAnalyses($inpatient_id, $analyses_id)
    {
        try {
            $data = $this->analysis_repo->getInpatientAnalysesWithDoctor($analyses_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw analyzes request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw analyzes request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientAllProcedures($inpatient_id)
    {
        try {
            $data = $this->procedureRepository->getInpatientProceduresWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient procedures request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient procedures request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getInpatientProcedure($inpatient_id, $procedure_id)
    {
        try {
            $data = $this->procedureRepository->getInpatientProcedureWithDoctor($procedure_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient procedures request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient procedures request(UnknownError)';
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

    public function getInpatientTemperatureLog($inpatient_id)
    {
        try {
            $data = $this->temperatureLogRepository->getInpatientTemperatureLogWithDoctorsSortedByDateDESC($inpatient_id);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient TemperatureLog request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient TemperatureLog request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size)
    {
        try {
            $data = $this->received_patient_repo->getAwaitingPrimaryInspectionReceivedPatientsSortByDatetimeAsc($page_size);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw received_patient request(DAL Error)';
            throw new PatientServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw received_patient request(UnknownError)';
            throw new PatientServiceException($message, 0, $e);
        }
    }

}