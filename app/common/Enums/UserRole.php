<?php


namespace App\Common\Enums;
use App\Common\Enum;


class UserRole extends Enum
{
    const ADVERTISER = 0;
    const WEBMASTER = 1;
    const MODERATOR = 3;
    const ADMIN = 2;
    
}