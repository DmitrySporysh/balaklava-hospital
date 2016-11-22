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


    public function  __construct(UserRepositoryInterface $user_repo,
                                 PatientRepositoryInterface $patient_repo,
                                 InpatientRepositoryInterface $inpatient_repo,
                                 ReceivedPatientRepositoryInterface $received_patient_repo,
                                 HealthWorkerRepositoryInterface $doctor_repo,
                                 HospitalDepartmentRepositoryInterface $departmentRepository ,
                                 HospitalRepositoryInterface $hospitalRepository,
                                 DischargeRepositoryInterface $dischargeRepository

    ){
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
        $this->departmentRepository = $departmentRepository;
        $this->hospitalRepository = $hospitalRepository;
        $this->dischargeRepository = $dischargeRepository;
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

    public function getAllDepartments()
    {
        try {
            $data =  $this->departmentRepository->all(['id', 'department_name']);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw departments request(DAL Error)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
    }

    public function getAllHospitals()
    {
        try {
            $data =  $this->hospitalRepository->all(['id', 'hospital_name']);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw hospitals request(DAL Error)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw hospitals request(UnknownError)';
            throw new DepartmentChiefServiceException($message,0,$e);
        }
    }

    public function addAttendingDoctorToInpatient($requestData)
    {
        try {
            $this->inpatient_repo->update(['attending_doctor_id' => $requestData->doctor_id], $requestData->inpatient_id);
            return ['success' => true];
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

    public function dischargeInpatientFromDepartment($requestData)
    {
        try {
            $dischargeDataFromRequest = $this->getDischargeDataFromRequest($requestData);
            $newDischarge = $this->dischargeRepository->create($dischargeDataFromRequest);
            return $newDischarge;
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