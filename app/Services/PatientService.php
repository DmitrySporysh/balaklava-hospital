<?php
namespace App\Services;

use App\Exceptions\HealthWorkerServiceException;
use App\Exceptions\DALException;
use App\Repositories\Interfaces\HealthWorkerRepositoryInterface;
use App\Repositories\Interfaces\InpatientRepositoryInterface;
use App\Repositories\Interfaces\ReceivedPatientRepositoryInterface;
use App\Services\Interfaces\DoctorServiceInterface;
use \Exception;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

use Barryvdh\Debugbar\Facade;
use Debugbar;

class PatientService implements DoctorServiceInterface
{
    private $patient_repo;
    private $inpatient_repo;
    private $received_patient_repo;
    private $doctor_repo;


    public function  __construct(PatientRepositoryInterface $patient_repo,
                                 InpatientRepositoryInterface $inpatient_repo,
                                 ReceivedPatientRepositoryInterface $received_patient_repo,
                                 HealthWorkerRepositoryInterface $doctor_repo

    ){
        $this->patient_repo = $patient_repo;
        $this->inpatient_repo = $inpatient_repo;
        $this->received_patient_repo = $received_patient_repo;
        $this->doctor_repo = $doctor_repo;
    }

    public function getInpatientFullInfo(Request $request, $inpatient_id)
    {
        $response = $this->doctor_service->getInpatientFullInfo($inpatient_id);
        Debugbar::info($response);
        return view('welcome', ['response' => $response]);
        //return $response;
    }


    public function getReceivedPatient(Request $request, $received_patient_id)
    {
        $response = $this->doctor_service->getReceivedPatientFullInfo($received_patient_id);
        //Debugbar::info($response);
        //return view('welcome', ['response' => $response]);
        return $response;
    }
    public function getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size)
    {
        try {
            $data =  $this->inpatient_repo->getDoctorAllInpatientsSortByDateDesc($doctor_id, $page_size);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw inpatient request(DAL Error)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
    }

    public function getAwaitingPrimaryInspectionPatientsSortByDatetimeAsc($page_size)
    {
        try {
            $data =  $this->received_patient_repo->getAwaitingPrimaryInspectionReceivedPatientsSortByDatetimeAsc($page_size);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw received_patient request(DAL Error)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw received_patient request(UnknownError)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
    }

    public function getReceivedPatientFullInfo($received_patient_id)
    {
        try {
            $data =  $this->received_patient_repo->getReceivedPatientWithPatientInfo($received_patient_id);
            return $data;
        }
        catch(DALException $e){
            $message = 'Error while creating withdraw received_patient request(DAL Error)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
        catch(Exception $e){
            $message = 'Error while creating withdraw received_patient request(UnknownError)';
            throw new HealthWorkerServiceException($message,0,$e);
        }
    }


    public function addNewInspectionProtocolWithPatient(Request $request)
    {
        try {
            $patient_id = $this->checkInpatientExists($request->inpatients_id);


            if ($patient_id != null) {
                Debugbar::info('not null1');

                $data = $this->received_patient_repo->create([
                    'patient_id' => $patient_id['id'],
                    'registration_nurse_id' => 5,
                    'received_date' => Carbon::now()->toDateTimeString(),
                    'fio' => $request->fio,
                    'work_place' => $request->work_place,
                    'marital_status' => $request->marital_status,
                    'residential_address' => $request->residential_address,
                    'registration_address' => $request->registration_address,
                    'phone' => $request->phone,
                    'complaints' => $request->complaints,
                    'received_type' => $request->received_type
                ]);

            } else {
                $this->received_patient_repo->createNewPatientAndReceivedPatient(
                    [
                        'sex' => $request->sex,
                        'insurance_number' => $request->insurance_number,
                        'birth_date' => '1990-10-10',
                    ],
                    [
                        'patient_id' => null,
                        'registration_nurse_id' => 5,
                        'received_date' => Carbon::now()->toDateTimeString(),
                        'fio' => $request->fio,
                        'work_place' => $request->work_place,
                        'marital_status' => $request->marital_status,
                        'residential_address' => $request->residential_address,
                        'registration_address' => $request->registration_address,
                        'phone' => $request->phone,
                        'complaints' => $request->complaints,
                        'received_type' => $request->received_type
                    ]
                );
            }

            return "Пациент успешно добавлен";
        } catch (DALException $e) {
            $message = 'Error while creating withdraw inpatient request(DAL Error)' . $e->getMessage();
            throw new HealthWorkerServiceException($message, 0, $e);
        } catch (Exception $e) {
            $message = 'Error while creating withdraw inpatient request(UnknownError)';
            throw new HealthWorkerServiceException($message, 0, $e);
        }
    }

}