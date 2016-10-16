<?php


namespace App\Common\Enums;
use App\Common\Enum;

class ProjectRotationType extends Enum
{
    const PER_CLICK = 0;
    const PER_SHOW = 1;
    const PER_BUDGET=2;
    const PER_VALIDITY=3;
}