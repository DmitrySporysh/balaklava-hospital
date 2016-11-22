<?php
namespace App\Services;

use App\Exceptions\EmergencyServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\AnalysisRepositoryInterface;
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
    private $analysisRepository;


    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo,
                                AnalysisRepositoryInterface $analysisRepository

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->analysisRepository = $analysisRepository;
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

    public function getAllNotReadyAnalyzes()
    {
        try {
            $data = $this->analysisRepository->getALLNotReadyAnalyzesWithDoctorsSortedByDateDESC();
            return $data;
        } catch (DALException $e) {
            $message = 'Error while creating withdraw patients analyzes request(DAL Error)';
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw patients analyzes request(UnknownError)';
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

    private function getReceivedPatientDataFromRequest($requestData, $registration_nurse_id, $patient_id = null)
    {
        //Debugbar::info($requestData);
        $data = $requestData;
        unset($data['birth_date']);
        unset($data['sex']);
        unset($data['insurance_number']);
        $data['patient_id'] = $patient_id;
        $data['registration_nurse_id'] = $registration_nurse_id;
        $data['received_date'] = Carbon::now()->toDateTimeString();
        return $data;
    }

    private function getPatientDataFromRequest($requestData)
    {
        //Debugbar::info($requestData);
        $data['birth_date'] = $requestData->birth_date;
        $data['sex'] = $requestData->sex;
        $data['insurance_number'] = $requestData->insurance_number;

        return $data;
    }


    public function addNewPatient($requestData, $registration_nurse_id)
    {
        try {
            $patient_id = $this->checkPatientExists($requestData->insurance_number);

            if ($patient_id != null) {

                $received_patient_data = $this->getReceivedPatientDataFromRequest($requestData, $registration_nurse_id, $patient_id);
                $this->received_patient_repo->create($received_patient_data);

            } else {
                $patient_data = $this->getPatientDataFromRequest($requestData);
                $received_patient_data = $this->getReceivedPatientDataFromRequest($requestData, $registration_nurse_id);

                $this->received_patient_repo->createNewPatientAndReceivedPatient($patient_data, $received_patient_data);
            }

            return json_encode(['success' => true, 'message' => "Новый пациент успешно добавлен"]);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)' . $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)'. $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        }
    }

    private function getAnalysisDataFromRequest($requestData)
    {
        //Debugbar::info($requestData);
        $data['ready_date'] = $requestData->birth_date;
        $data['result_description'] = $requestData->sex;
        $data['paths_to_files analysis '] = $this->saveFile($requestData->file);

        return $data;
    }


    public function addAnalysisResult($requestData, $registration_nurse_id)
    {
        try {
            $dataForUpdate = $this->getAnalysisDataFromRequest($requestData);

            $this->analysisRepository->update($dataForUpdate, $requestData->analysis_id);

            return json_encode(['success' => true, 'message' => "Результат анализа успешно сохранен"]);
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)' . $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)'. $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        }
    }
}