<?php


namespace App\Common\Enums;
use App\Common\Enum;

class MoneyOperationStatus extends Enum
{
    const COMPLETED = 1;
    const WAITING = 0;
    const FROZEN = 2;
}