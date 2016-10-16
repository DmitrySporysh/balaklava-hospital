<?php


namespace App\Common\Enums;
use App\Common\Enum;

class BannerStatus extends Enum
{
    const ACTIVE = 1;
    const INACTIVE = 0;
    const ON_MODERATION = 2;
    const BANNED = 3;
}