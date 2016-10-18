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
}