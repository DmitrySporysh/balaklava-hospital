<?php


namespace App\Services\Interfaces;


interface UserServiceInterface
{
    public function getProfileData($id);

    public function setProfileData($id,$data);

    public function getMoneyOperationsHistory($id, $page_size);

    public function getCurrentBalance($id);

    public function createMoneyWithdrawRequest($id,$money,$qiwi);

    //заглушка
    public function fillBalance($id);

    public function getAllStandartBannerSizes();



    public function getThematics();

    public function getCategories();

    public function getInboxMessage($id, $page_size);

    public function getSendedMessage($id, $page_size);

    public function getContacts($id, $page_size);

    public function updateStatusMessage($id_message, $status, $user_role);

    public function sendMessage($userId,$data);

    public function getIdCorrespondence();

    public function getAmountOfNewMessage($id_user);

    public function getCurrentInboxMessage($id_message);

    public function getCurrentSendedMessage($id_message);

    public function getUserIdByEmail($email);

}