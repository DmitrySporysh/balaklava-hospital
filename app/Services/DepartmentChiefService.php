<?php
namespace App\Services;

use App\Exceptions\DepartmentChiefServiceException;
use App\Exceptions\DALException;
use App\Repositories\HospitalDepartmentRepository;
use App\Repositories\Interfaces\DischargeRepositoryInterface;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\HospitalDepartmentRepositoryInterface;
use App\Repositories\Interfaces\HospitalRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\DepartmentChiefServiceInterface;
use Carbon\Carbon;
use \Exception;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Validator;


class DepartmentChiefService implements DepartmentChiefServiceInterface
{
    private $user_repo;
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;
    private $doctor_repo;
    private $departmentRepository;
    private $hospitalRepository;
    private $dischargeRepository;
    private $validator;


    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo,
                                HealthWorkerRepositoryInterface $doctor_repo,
                                HospitalDepartmentRepositoryInterface $departmentRepository,
                                HospitalRepositoryInterface $hospitalRepository,
                                DischargeRepositoryInterface $dischargeRepository

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
        $this->departmentRepository = $departmentRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->dischargeRepository = $dischargeRepository;
    }

    /*
     * Получение списка пациентов в отделении $department_id
     */
    public function getDepartmentAllInpatientsSortByDateDesc($department_id, $page_size)
    {
        try {
            $data = $this->inpatient_repo->getDepartmentAllInpatientsSortByDateDesc($department_id, $page_size);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    /*
     * Получение списка врачей в отделении $department_id
     */
    public function getDepartmentAllDoctorsSortByFio($department_id, $page_size)
    {
        try {
            $data = $this->doctor_repo->getDepartmentAllDoctorsSortByFio($department_id, $page_size);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    public function getAllDepartments()
    {
        try {
            $data = $this->departmentRepository->all(['id', 'department_name']);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw departments request(DAL Error)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    public function getAllHospitals()
    {
        try {
            $data = $this->hospitalRepository->all(['id', 'hospital_name']);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw hospitals request(DAL Error)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw hospitals request(UnknownError)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    /*
     * назначение пациенту нового лечащего врача
     */
    private function validateDataForAddingAttendingDoctorToInpatientRequest($requestData)
    {
        $messages = array(
            'doctor_id.required' => "Поле 'id врача' должно быть заполнено",
            'doctor_id.exists'=>'Доктора с таким id не существует',
            'inpatient_id.required' => "Поле 'id пациента' должно быть заполнено",
            'inpatient_id.exists' => "Пациента с таким id не существует",
        );
        try {
            $this->validator = Validator::make($requestData, [
                'doctor_id' => 'required|exists:health_workers,id',
                'inpatient_id' => 'required|exists:inpatients,id'
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Ошибка валидации полей';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    public function addAttendingDoctorToInpatient($requestData)
    {
        try {
            $validationMessages = $this->validateDataForAddingAttendingDoctorToInpatientRequest($requestData);
            if(!empty($validationMessages))
            {
                return ['success' => false, 'data' => null, 'message' => $validationMessages ];
            }

            $this->inpatient_repo->update(['attending_doctor_id' => $requestData['doctor_id']], $requestData['inpatient_id']);
            return ['success' => true, 'result' => 'Лечащий врач успешно назначен пациенту'];
        } catch (DALException $e) {
            $message = 'Error while updating withdraw inpatient in request(DAL Error)' . $e->getMessage();
            throw new DepartmentChiefServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while updating withdraw inpatient creating withdraw procedure request(UnknownError)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    private function getDischargeDataFromRequest($requestData)
    {
        $requestData['discharge_date'] = Carbon::now()->toDateTimeString();
        return $requestData;
    }

    private function validateDischargeData($requestData)
    {
        $messages = array(
            'inpatient_id.required' => "Поле 'id пациента' должно быть заполнено",
            'inpatient_id.exists' => "Пациента с таким id не существует",
        );
        try {
            $this->validator = Validator::make($requestData, [
                'inpatient_id' => 'required|exists:inpatients,id',
                'result_epicrisis' => 'required|max:255',
                'discharge_type' => 'required|in:Выписан,Перевод в отделение,Перевод  в больницу,Умер',
                'discharge_department_id' => 'required_if:discharge_type,Перевод в отделение',
                'discharge_hospital_id' => 'required_if:discharge_type,Перевод в больницу'
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Ошибка валидации полей';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

    public function dischargeInpatientFromDepartment($requestData)
    {
        try {
            $validationMessages = $this->validateDischargeData($requestData);
            if(!empty($validationMessages))
            {
                return ['success' => false, 'data' => null, 'message' => $validationMessages ];
            }

            $dischargeDataFromRequest = $this->getDischargeDataFromRequest($requestData);

            $this->dischargeRepository->addDischargeAndDeleteInpatient($dischargeDataFromRequest);
            return ['success' => true, 'data' => null, 'message' => 'Пациент успешно выписан'];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw discharge request(DAL Error)' . $e->getMessage();
            throw new DepartmentChiefServiceException($message, 0, $e);
        } catch
        (Exception $e) {
            $message = 'Error while creating withdraw discharge request(UnknownError)';
            throw new DepartmentChiefServiceException($message, 0, $e);
        }
    }

}