<?php


namespace App\Common\Enums;
use App\Common\Enum;

class SiteStatus extends Enum
{
    const ONMODERATION = 2;
    const ACTIVE = 1;
    const BANNED = 0;

}