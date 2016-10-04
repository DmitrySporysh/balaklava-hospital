<?php


namespace App\Services\Interfaces;



use Illuminate\Http\Request;



interface AttendingDoctorServiceInterface
{

    public function getAllBannerRequests($user_id,$page_size);

    public function addAllNewSiteData(Request $request,$user_id);

    public function getSitesFullInfo($webmaster_id,$page_size);

    public function editSite(Request $request,$user_id);

    public function acceptRequest($show_request_id);

    public function rejectRequest($show_request_id);


    public function getOneSiteInfo($site_id);

    public function getSelectedCategories($site_id);

    public function getSelectedThematics($site_id);

    public function deletePage($user_id,$page_id);

    public function deleteSite($user_id,$site_id);
}