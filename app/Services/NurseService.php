<?php


namespace App\Services;

//Exceptions
use App\Exceptions\NurseServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\HospitalDepartmentRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\MedicalAppointmentRepositoryInterface;
use \Exception;
//Services interfaces
use App\Services\Interfaces\NurseServiceInterface;
//repo interfaces
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\ChamberRepositoryInterface;
use App\Repositories\Interfaces\ProcedureRepositoryInterface;
use App\Repositories\Interfaces\InspectionRepositoryInterface;
use App\Repositories\Interfaces\OperationRepositoryInterface;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
//
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;


class NurseService implements NurseServiceInterface
{

    private $user_repo;
    private $patient_repo;
    private $inpatient_repo;
    private $chamber_repo;
    private $dressing_repo;
    private $inspection_repo;
    private $operation_repo;
    private $medical_appointment_repo;
    private $nurse_repo;
    private $department_repo;

    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ChamberRepositoryInterface $chamber_repo,
                                ProcedureRepositoryInterface $dressing_repo,
                                InspectionRepositoryInterface $inspection_repo,
                                OperationRepositoryInterface $operation_repo,
                                MedicalAppointmentRepositoryInterface $medical_appointment_repo,
                                HospitalDepartmentRepositoryInterface $department_repo,
                                HealthWorkerRepositoryInterface $nurse_repo

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->chamber_repo = $chamber_repo;
        $this->dressing_repo = $dressing_repo;
        $this->inspection_repo = $inspection_repo;
        $this->operation_repo = $operation_repo;
        $this->medical_appointment_repo = $medical_appointment_repo;
        $this->nurse_repo = $nurse_repo;
        $this->department_repo = $department_repo;
    }

    public function getAllDepartmentsWithDepartmentChiefFio()
    {
        try {
            return $this->department_repo->getAllDepartmentsWithDepartmentChiefFio();
        } catch (DALException $e) {
            $message = 'Error while creating withdraw departments request(DAL Error)';
            throw new NurseServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw departments request(UnknownError)';
            throw new NurseServiceException($message, 0, $e);
        }
    }

    public function getDepartmentChambers($department_id)
    {
        try {
            //$data['department'] = $this->department_repo->find($department_id, array('department_name'));
            //$data['chambers'] = $this->chamber_repo->getNotEmptyChambersByDepartmentNum($department_id,
            //    array('id', 'number', 'beds_occupied_count'));
            return $this->chamber_repo->getNotEmptyChambersByDepartmentNum($department_id, array('id', 'number', 'beds_occupied_count'));
        } catch (DALException $e) {
            $message = 'Error while creating withdraw departments request(DAL Error)';
            throw new NurseServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw departments request(UnknownError)';
            throw new NurseServiceException($message, 0, $e);
        }
    }

    public function getChamberWithPatients($chamber_id)
    {
        try {
            //$data['chamber'] = $this->chamber_repo->where('id', $chamber_id, '=', array('id as chamber_id', 'number'));
            //$data['inpatients'] = $this->inpatient_repo->getInpatientsGeneralInfoByChamberId($chamber_id);
            return $this->inpatient_repo->getInpatientsGeneralInfoByChamberId($chamber_id, ['fio', 'inpatients.id']);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw chamber request(DAL Error)';
            throw new NurseServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw chamber request(UnknownError)';
            throw new NurseServiceException($message, 0, $e);
        }
    }
}