<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories\Interfaces;


interface ReceivedPatientRepositoryInterface extends RepositoryInterface
{
    public function getReceivedPatientsWithPatientInfoSortByDateDesc_Paginate($per_page);
    
    public function getAwaitingPrimaryInspectionReceivedPatientsSortByDatetimeAsc($per_page);

    public function createNewPatientAndReceivedPatient($patientInfo, $receivedPatientInfo);

    public function getReceivedPatientWithPatientInfo($received_patient_id, $columns);

    public function getReceivedPatientInspectionProtocolInfo($received_patient_id);

    public function getAllPatientsSortedAndFiltered($page_size, $columns, $filters = null);

    public function addNewInspectionProtocol($inspection_protocol_data, $received_patient_id);
}