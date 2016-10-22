<?php
namespace App\Services;

use App\Exceptions\DoctorServiceException;
use App\Exceptions\DALException;
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


    public function __construct(UserRepositoryInterface $user_repo,
                                PatientRepositoryInterface $patient_repo,
                                InpatientRepositoryInterface $inpatient_repo,
                                ReceivedPatientRepositoryInterface $received_patient_repo,
                                HealthWorkerRepositoryInterface $doctor_repo

    )
    {
        $this->user_repo = $user_repo;
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
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

}