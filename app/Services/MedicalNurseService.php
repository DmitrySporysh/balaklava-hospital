<?php
namespace App\Services;

use App\Exceptions\EmergencyServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\MedicalNurseServiceInterface;
use Carbon\Carbon;
use \Exception;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\DistrictDoctorRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Barryvdh\Debugbar\Facade;
use Debugbar;


class MedicalNurseService implements MedicalNurseServiceInterface
{
    private $user_repo;
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;


    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
    }


    public function getAllReceivedPatientsSortByDateDesc($page_size)
    {
        try {
            $data = $this->received_patient_repo->getReceivedPatientsWithPatientInfoSortByDateDesc_Paginate($page_size);
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient request(DAL Error)';
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient request(UnknownError)';
            throw new EmergencyServiceException($message, 0, $e);
        }
    }

    private function checkPatientExists($insurance_number)
    {
        try {
            $data = $this->patient_repo->where('insurance_number', $insurance_number, '=', ['id']);
            if($data != null)
                return $data[0]['id'];
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patient request(DAL Error)';
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patient request(UnknownError)';
            throw new EmergencyServiceException($message, 0, $e);
        }
    }

    private function getReceivedPatientDataFromRequest(Request $request, $registration_nurse_id, $patient_id = null)
    {
        $data = $request->all();
        unset($data['birth_date']);
        unset($data['sex']);
        unset($data['insurance_number']);
        $data['patient_id'] = $patient_id;
        $data['registration_nurse_id'] = $registration_nurse_id;
        $data['received_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    private function getPatientDataFromRequest(Request $request)
    {
        $data['birth_date'] = $request->birth_date;
        $data['sex'] = $request->sex;
        $data['insurance_number'] = $request->insurance_number;

        return $data;
    }


    public function addNewPatient(Request $request, $registration_nurse_id)
    {
        try {
            $patient_id = $this->checkPatientExists($request->insurance_number);

            if ($patient_id != null) {

                $received_patient_data = $this->getReceivedPatientDataFromRequest($request, $registration_nurse_id, $patient_id);
                $this->received_patient_repo->create($received_patient_data);

            } else {
                $patient_data = $this->getPatientDataFromRequest($request);
                $received_patient_data = $this->getReceivedPatientDataFromRequest($request, $registration_nurse_id);

                $this->received_patient_repo->createNewPatientAndReceivedPatient($patient_data, $received_patient_data);
            }

            return "Новый пациент успешно добавлен";
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)' . $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new EmergencyServiceException($message, 0, $e);
        }
    }


    public function ediPatient(Request $request, $patient_id)
    {
        // TODO: Implement ediPatient() method.
    }
}