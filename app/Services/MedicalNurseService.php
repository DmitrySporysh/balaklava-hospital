<?php
namespace App\Services;

use App\Exceptions\EmergencyServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\AnalysisRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\FileServiceInterface;
use App\Services\Interfaces\MedicalNurseServiceInterface;
use Carbon\Carbon;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Exception;

use Debugbar;
use Validator;


class MedicalNurseService implements MedicalNurseServiceInterface
{
    private $user_repo;
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;
    private $analysisRepository;
    private $fileService;
    private $validator;

    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo,
                                AnalysisRepositoryInterface $analysisRepository,
                                FileServiceInterface $fileService

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->analysisRepository = $analysisRepository;
        $this->fileService = $fileService;
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
            if ($data != null)
                return $data[0]['id'];
            return null;
        } catch (Exception $e) {
            return null;
        }
    }

    private function getReceivedPatientDataFromRequest($requestData, $registration_nurse_id, $patient_id = null)
    {
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
        $data['birth_date'] = $requestData['birth_date'];
        $data['sex'] = $requestData['birth_date'];
        $data['insurance_number'] = $requestData['insurance_number'];
        return $data;
    }

    private function validatePatientData($patientData)
    {
        $messages = array(
            'fio.required' => "Поле 'fio' должно быть заполнено",
            'fio.between' => "Поле 'fio' должно быть от 8 до 255 символов",

            'sex.required' => "Поле 'sex' должно быть заполнено",
            'sex.in' => "Поле 'sex' должно иметь значение 'Мужской' или 'Женский'",

            'work_place.required' => "Поле 'work_place' должно быть заполнено",
            'work_place.max' => "Поле 'work_place' должно быть не больше 255 символов",

            'birth_date.required' => "Поле 'birth_date' должно быть заполнено",
            'birth_date.date' => "Поле 'birth_date' должно иметь формат даты",

            'marital_status.required' => "Поле 'marital_status' должно быть заполнено",
            'marital_status.in' => "Поле 'marital_status' должно иметь значение 'В браке' или 'Не в браке'",

            'residential_address.required' => "Поле 'residential_address' должно быть заполнено",
            'residential_address.max' => "Поле 'residential_address' должно быть не больше 255 символов",

            'registration_address.required' => "Поле 'registration_address' должно быть заполнено",
            'registration_address.max' => "Поле 'registration_address' должно быть не больше 255 символов",

            'phone.required' => "Поле 'phone' должно быть заполнено",
            'phone.between' => "Поле 'phone' должно быть от 11 до 18 символов",

            'received_type.required' => "Поле 'received_type' должно быть заполнено",
            'received_type.in' => "Поле 'received_type' должно иметь значение 'Планово', 'Экстренно' или 'По скорой'",

            'insurance_number.required' => "Поле 'insurance_number' должно быть заполнено",
            'insurance_number.max' => "Поле 'insurance_number' должно быть не больше 16 символов",

            'complaints.required' => "Поле 'complaints' должно быть заполнено",
            'complaints.max' => "Поле 'complaints' должно быть не больше 255 символов"

        );
        try {
            $this->validator = Validator::make($patientData, [
                'fio' => 'required|between:8,255',
                'sex' => 'required|in:Мужской,Женский',
                'work_place' => 'required|max:255',
                'birth_date' => 'required|date',
                'marital_status' => 'required|in:В браке,Не в браке',
                'residential_address' => 'required|max:255',
                'registration_address' => 'required|max:255',
                'phone' => 'required|between:11,18',
                'received_type' => 'required|in:Планово,Экстренно,По скорой',
                'insurance_number' => 'required|max:16',
                'complaints' => 'required|max:255'
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Ошибка валидации полей';
            throw new EmergencyServiceException($message, 0, $e);
        }
    }

    public function addNewPatient($requestData, $registration_nurse_id)
    {
        try {
            $validationMessages = $this->validatePatientData($requestData);
            if(!empty($validationMessages))
            {
                return ['success' => false, 'data' => null, 'message' => $validationMessages ];
            }

            $patient_id = $this->checkPatientExists($requestData['insurance_number']);

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
            $message = 'Error while creating withdraw inpatient request(UnknownError)' . $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        }
    }

    private function getAnalysisDataFromRequest($requestData, $nurse_id)
    {
        $data['paths_to_files'] = $this->fileService->save($requestData['file']);

        $data['ready_date'] = Carbon::now()->toDateTimeString();
        $data['result_description'] = $requestData['result_description'];
        $data['doctor_who_performed'] = $nurse_id;
        $data['paths_to_files'] = $this->fileService->save($requestData['file']);
        return $data;
    }

    private function validateAnalysisResultData($analysisResult_data)
    {
        $messages = array(
            'analyses_id.required' => "Поле 'id анализа' должно быть заполнено",
            'analyses_id.exists'=>'Анализа с таким id не существует',
            'result_description.required' => "Поле 'описание результата' должно быть заполнено",
            'result_description.max' => "Поле 'описание результата' должно быть не больше 255 символов",
        );
        try {
            $this->validator = Validator::make($analysisResult_data, [
                'analyses_id' => 'required|exists:analyzes,id',
                'result_description' => 'required|max:255'
            ], $messages);
            if ($this->validator->fails()) {
                return $this->validator->messages();
            }
        } catch (Exception $e) {
            $message = 'Ошибка валидации полей';
            throw new EmergencyServiceException($message, 0, $e);
        }
    }

    public function addAnalysisResult($requestData, $nurse_id)
    {

        try {
            Debugbar::info('$str');
            Debugbar::info($requestData['file']);
            $str = $this->fileService->save($requestData['file'], 'analyzes', '12');
            Debugbar::info($str);
            return 'fdf';

            $validationMessages = $this->validateAnalysisResultData($requestData);
            if(!empty($validationMessages))
            {
                return ['success' => false, 'data' => null, 'message' => $validationMessages ];
            }

            $analysisResultData = $this->getAnalysisDataFromRequest($requestData, $nurse_id);
            $this->analysisRepository->update($analysisResultData, $requestData['analyses_id']);
            return ['success' => true, 'message' => "Результат анализа успешно сохранен"];
        } catch (DALException $e) {
            $message = 'Error while creating withdraw analysis request(DAL Error)' . $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        } catch (Exception $e) {
            Debugbar::info($e->getMessage());
            $message = 'Error while creating withdraw analysis request(UnknownError)' . $e->getMessage();
            throw new EmergencyServiceException($message, 0, $e);
        }
    }
}