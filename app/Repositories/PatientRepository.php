<?php
/**
 * Created by PhpStorm.
 * User: DmitrySpor
 * Date: 04.10.2016
 * Time: 12:33
 */
namespace App\Repositories;
use App\Exceptions\DALException;
use App\Models\Patient;
use App\Repositories\Core\Repository;
use App\Repositories\Interfaces\PatientRepositoryInterface;
use Exception;


class PatientRepository extends Repository implements PatientRepositoryInterface
{
    function model()
    {
        return 'App\Models\Patient';
    }

    public function getPatientFullInfo($patient_id){

        try {
            $data = Patient::where('id', $patient_id)
                ->with(['dressings', 'operations' , 'inspection', 'treatments', 'surveys',
                    'chamber', 'hospital_department', 'attending_doctor', 'district_doctor'
                ])->get();
            ;
            if ($data == null) {
                return array();
            }
        } catch (Exception $e) {
            $message = 'Error while finding element using ' . $this->model();
            throw new DALException($message, 0, $e);
        }

        if($data!=null) return $data;

        return array();
    }

        public function getAllPatientsFullInfo($page_size){
        /*try {
            $banner_requests = Banner::
            join('banner_show_requests', 'banners.id', '=', 'banner_show_requests.id_banner')
                ->join('banner_places', 'banner_show_requests.id_place', '=', 'banner_places.id')
                ->join('projects','banners.id_project','=','projects.id')
                ->join('users as advertisers','projects.id_advertiser','=','advertisers.id')
                ->join('site_pages', 'banner_places.id_page', '=', 'site_pages.id')
                ->join('sites', 'site_pages.id_site', '=', 'sites.id')
                ->join('users', 'sites.id_webmaster', '=', 'users.id')
                ->where('users.id', $id_user)
                ->where('banner_show_requests.status', BannerShowRequestStatus::UNTREATED)
                ->select('banners.name as banner_name',
                    'banners.domain as banner_domain',
                    'banners.size as banner_size',
                    'banners.click_price',
                    'banners.show_price',
                    'banners.max_clicks',
                    'banners.max_shows',
                    'sites.domain',
                    'banner_show_requests.deadline',
                    'site_pages.name as page_name',
                    'advertisers.id as advertisers_id',
                    'banner_show_requests.id as request_id')
                ->paginate($page_size);
        }

        catch(Exception $e) {
            $message = 'Error while finding element using '.$this->model();
            throw new DALException($message,0,$e);
        }
        /*if($banner_requests !=null) {
            for ($i = 0; $i < count($banner_requests); $i++) {
                $banner_requests[$i] = (array)$banner_requests[$i];
            }
            return $banner_requests;
        }*/
       /* if($banner_requests!=null) return $banner_requests;
        return array();
*/
    }
}