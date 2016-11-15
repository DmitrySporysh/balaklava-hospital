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

    private function getInspectionProtocolDataFromRequest(Request $request, $doctor_id)
    {
        $data = $request->all();
        unset($data['id']);
        unset($data['complaints']);
        $data['duty_doctor_id'] = $doctor_id;
        $data['date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInspectionProtocol(Request $request, $doctor_id)
    {
        try {
            if ($request->complaints)
                $this->received_patient_repo->update(['complaints' => $request->complaints], $request->id);
            $inspection_protocol_data = $this->getInspectionProtocolDataFromRequest($request, $doctor_id);
            $this->received_patient_repo->addNewInspectionProtocol($inspection_protocol_data, $request->id);

            return "Протокол осмотра пациента №".$request->id.' успешно добавлен';
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inspection protocol request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw inspection protocol request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getAnalisisDataFromRequest(Request $request, $doctor_id)
    {
        $data = $request->all();
        $data['doctor_who_appointed'] = $doctor_id;
        $data['appointment_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInpatientAnalysis($request, $doctor_id)
    {
        try {
            $analysis_data = $this->getAnalisisDataFromRequest($request, $doctor_id);
            return $this->analysisRepository->create($analysis_data);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw analysis request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw analysis request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getProcedureDataFromRequest(Request $request, $doctor_id)
    {
        $data = $request->all();
        $data['doctor_who_appointed'] = $doctor_id;
        $data['procedure_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInpatientProcedure($request, $doctor_id)
    {
        try {
            $procedureDataFromRequest = $this->getProcedureDataFromRequest($request, $doctor_id);
            return $this->procedureRepository->create($procedureDataFromRequest);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw procedure request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw procedure request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getInspectionDataFromRequest(Request $request, $doctor_id)
    {
        $data = $request->all();
        $data['doctor_id'] = $doctor_id;
        $data['inspection_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInpatientInspection($request, $doctor_id)
    {
        try {
            $inspectionDataFromRequest = $this->getInspectionDataFromRequest($request, $doctor_id);
            return $this->inspectionRepository->create($inspectionDataFromRequest);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inspection request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw inspection request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getOperationDataFromRequest(Request $request, $doctor_id)
    {
        $data = $request->all();
        $data['doctor_who_appointed'] = $doctor_id;
        $data['appointment_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInpatientOperation($request, $doctor_id)
    {
        try {
            $operationDataFromRequest = $this->getOperationDataFromRequest($request, $doctor_id);
            return $this->operationRepository->create($operationDataFromRequest);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw operation request(DAL Error)' . $e->getMessage();
            throw new DoctorServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw operation request(UnknownError)';
            throw new DoctorServiceException($message, 0, $e);
        }
    }

    private function getMedicalAppointmentDataFromRequest(Request $request, $doctor_id)
    {
        $data = $request->all();
        $data['doctor_id'] = $doctor_id;
        $data['date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    public function addNewInpatientMedicalAppointment($request, $doctor_id)
    {
        try {
            $medicalAppointmentsDataFromRequest = $this->getMedicalAppointmentDataFromRequest($request, $doctor_id);
            return $this->medicalAppointmentRepository->create($medicalAppointmentsDataFromRequest);
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