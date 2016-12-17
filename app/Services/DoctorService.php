<?php
namespace App\Services;

use App\Exceptions\DoctorServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\AnalysisRepositoryInterface;
use App\Repositories\Interfaces\InspectionRepositoryInterface;
use App\Repositories\Interfaces\MedicalAppointmentRepositoryInterface;
use App\Repositories\Interfaces\OperationRepositoryInterface;
use App\Repositories\Interfaces\ProcedureRepositoryInterface;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\DoctorServiceInterface;
use Carbon\Carbon;
use \Exception;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\DistrictDoctorRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Barryvdh\Debugbar\Facade;
use Debugbar;
use Illuminate\Support\Facades\Auth;
use Validator;

class DoctorService implements DoctorServiceInterface
{
    private $user_repo;
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;
    private $doctor_repo;
    private $analysisRepository;
    private $procedureRepository;
    private $inspectionRepository;
    private $operationRepository;
    private $medicalAppointmentRepository;
    private $validator;


    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo,
                                HealthWorkerRepositoryInterface $doctor_repo,
                                AnalysisRepositoryInterface $analysisRepository,
                                ProcedureRepositoryInterface $procedureRepository,
                                InspectionRepositoryInterface $inspectionRepository,
                                OperationRepositoryInterface $operationRepository,
                                MedicalAppointmentRepositoryInterface $medicalAppointmentRepository

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
        $this->analysisRepository = $analysisRepository;
        $this->procedureRepository = $procedureRepository;
        $this->inspectionRepository = $inspectionRepository;
        $this->operationRepository = $operationRepository;
        $this->medicalAppointmentRepository = $medicalAppointmentRepository;
    }


    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size)
    {
        try {
            $data = $this->inpatient_repo->getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new DoctorServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getInspectionProtocolDataFromRequest($requestData, $doctor_id)
    {
        $data = $requestData;
        unset($data['id']);
        unset($data['complaints']);
        $data['duty_doctor_id'] = $doctor_id;
        $data['date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInspectionProtocol($requestData, $doctor_id)
    {
        try {
            if ($requestData['complaints'])
                $this->received_patient_repo->update(['complaints' => $requestData['complaints']], $requestData['id']);
            $inspection_protocol_data = $this->getInspectionProtocolDataFromRequest($requestData, $doctor_id);
            $this->received_patient_repo->addNewInspectionProtocol($inspection_protocol_data, $requestData['id']);

            return "Протокол осмотра пациента №".$requestData['id'].' успешно добавлен';
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inspection protocol request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw inspection protocol request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getAnalisisDataFromRequest($requestData, $doctor_id)
    {
        $data = $requestData;
        $data['doctor_who_appointed'] = $doctor_id;
        $data['appointment_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    private function validateAnalysisData($analysis_data)
    {
        $messages = array(
            'analysis_name.required' => 'Поле "Назание анализа" должно быть заполнено',
            'analysis_name.max'=>'Логин должен быть не больше 255 символов',
            'inpatient_id.required' => 'Поле "id пациента" должно быть заполнено',
            'inpatient_id.exists' => 'Пациента с таким id не существует',
            'analysis_description.max'=>'Логин должен быть не больше 255 символов',
            'doctor_who_appointed.required' => 'Поле "id лечащего врача" должно быть заполнено',
            'doctor_who_appointed.exists' => 'Врача с таким id не существует',
            'appointment_date.required' => 'Поле "дата назначения" должно быть заполненно',
            'appointment_date.date' => 'Поле "дата назначения" должно иметь формат даты и времени',
        );
        try {
            $this->validator = Validator::make($analysis_data, [
                'analysis_name' => 'required|max:255',
                'analysis_description' => 'required|max:255',
                'inpatient_id' => 'required|exists:inpatients,id',
                'doctor_who_appointed' => 'required|exists:health_workers,id',
                'appointment_date' => 'required|date'
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Ошибка валидации полей';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getAnalysisDataForResponse($newAnalysis)
    {
        $response['appointment_date'] =$newAnalysis['appointment_date'];
        $response['analysis_name'] =$newAnalysis['analysis_name'];
        $response['analysis_description'] =$newAnalysis['analysis_description'];
        return $response;
    }

    public function addNewInpatientAnalysis($request, $doctor_id)
    {
        try {
            $analysis_data = $this->getAnalisisDataFromRequest($request, $doctor_id);
            $validationMessages = $this->validateAnalysisData($analysis_data);
            if(!empty($validationMessages))
            {
                return ['success' => false, 'data' => null, 'message' => $validationMessages ];
            }

            $newAnalysis = $this->analysisRepository->create($analysis_data);
            $response = $this->getAnalysisDataForResponse($newAnalysis);

            return ['success' => true, 'data' => $response, 'message' => 'Направление на анализ успешно добавлено' ];
        } catch (DALException $e) {
            $message = 'Ошибка при добавлении нового направления на анализ(DAL Error)';
            throw new DoctorServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Ошибка при добавлении нового направления на анализ (UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getProcedureDataFromRequest($requestData, $doctor_id)
    {
        $data = $requestData;
        $data['doctor_who_appointed'] = $doctor_id;
        $data['appointment_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    private function getProcedureDataForResponse($newProcedure)
    {
        $response['procedure_name'] =$newProcedure['procedure_name'];
        $response['procedure_description'] =$newProcedure['procedure_description'];
        $response['appointment_date'] =$newProcedure['appointment_date'];
        $response['doctor_fio_who_appointed'] = Auth::user()->health_worker->fio;
        return $response;
    }

    public function addNewInpatientProcedure($requestData, $doctor_id)
    {
        try {
            $procedureDataFromRequest = $this->getProcedureDataFromRequest($requestData, $doctor_id);
            $newProcedure = $this->procedureRepository->create($procedureDataFromRequest);
            $response = $this->getProcedureDataForResponse($newProcedure);
            return ['success' => true, 'data' => $response, 'message' => 'Направление на процедуру успешно добавлено' ];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw procedure request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw procedure request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getInspectionDataFromRequest($requestData, $doctor_id)
    {
        $data = $requestData;
        $data['doctor_id'] = $doctor_id;
        $data['inspection_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    private function getInspectionDataForResponse($newInspection)
    {
        $response['inspection_date'] =$newInspection['inspection_date'];
        $response['state_type'] =$newInspection['state_type'];
        $response['description_extended'] =$newInspection['description_extended'];
        return $response;
    }

    public function addNewInpatientInspection($requestData, $doctor_id)
    {
        try {
            $inspectionDataFromRequest = $this->getInspectionDataFromRequest($requestData, $doctor_id);
            $newInspection = $this->inspectionRepository->create($inspectionDataFromRequest);
            $response = $this->getInspectionDataForResponse($newInspection);
            return ['success' => true, 'data' => $response, 'message' => 'Результат осмотра пациента успешно сохранен' ];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inspection request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw inspection request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getOperationDataFromRequest($requestData, $doctor_id)
    {
        $requestData['doctor_who_appointed'] = $doctor_id;
        $requestData['appointment_date'] = Carbon::now()->toDateTimeString();
        return $requestData;
    }

    private function getOperationDataForResponse($newOperation)
    {
        $response['operation_name'] =$newOperation['operation_name'];
        $response['appointment_date'] =$newOperation['appointment_date'];
        $response['preliminary_epicrisis'] =$newOperation['preliminary_epicrisis'];
        $response['operation_description'] =$newOperation['operation_description'];
        return $response;
    }

    public function addNewInpatientOperation($requestData, $doctor_id)
    {
        try {
            $operationDataFromRequest = $this->getOperationDataFromRequest($requestData, $doctor_id);
            $newOperation = $this->operationRepository->create($operationDataFromRequest);
            $response = $this->getOperationDataForResponse($newOperation);
            return ['success' => true, 'data' => $response, 'message' => 'Направление на операцию успешно добавлено' ];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw operation request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw operation request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    public function getAllNotReadyOperations()
    {
        try {
            $data = $this->operationRepository->getALLNotReadyOperationsWithDoctorsSortedByDateDESC();
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient operations request(DAL Error)';
            throw new DoctorServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient operations request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getOperationResultDataFromRequest($requestData, $doctor_id)
    {
        $requestData['doctor_who_performed'] = $doctor_id;
        $requestData['operation_date'] = Carbon::now()->toDateTimeString();
        unset($requestData['operation_id']);
        //$requestData['paths_to_files analysis '] = $this->saveFile($requestData->file);
        return $requestData;
    }

    public function addOperationResult($requestData, $doctor_id)
    {
        try {
            $dataForUpdate = $this->getOperationResultDataFromRequest($requestData, $doctor_id);
            $this->operationRepository->update($dataForUpdate, $requestData['operation_id']);
            return ['success' => true, 'message' => "Результат операции успешно сохранен"];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw operation request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw operation request(UnknownError)'. $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getMedicalAppointmentDataFromRequest($requestData, $doctor_id)
    {
        $data = $requestData;
        $data['doctor_id'] = $doctor_id;
        $data['date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    private function getMedicalAppointmentDataForResponse($newMedicalAppointment)
    {
        $response['date'] =$newMedicalAppointment['date'];
        $response['description'] =$newMedicalAppointment['description'];
        $response['doctor_fio'] = Auth::user()->health_worker->fio;
        return $response;
    }

    public function addNewInpatientMedicalAppointment($requestData, $doctor_id)
    {
        try {
            $medicalAppointmentsDataFromRequest = $this->getMedicalAppointmentDataFromRequest($requestData, $doctor_id);
            $newMedicalAppointment = $this->medicalAppointmentRepository->create($medicalAppointmentsDataFromRequest);
            $response = $this->getMedicalAppointmentDataForResponse($newMedicalAppointment);
            return ['success' => true, 'data' => $response, 'message' => 'Назначение успешно добавлено' ];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw Medical Appointment request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw Medical Appointment request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }
}