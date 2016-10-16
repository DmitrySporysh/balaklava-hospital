<?php


namespace App\Common\Enums;
use App\Common\Enum;

class ProjectStatus extends Enum
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    const ONMODERATION = 2;
    const BANNED = 3;
}