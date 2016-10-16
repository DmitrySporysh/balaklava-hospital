<?php


namespace App\Common\Enums;
use App\Common\Enum;

class WithdrawMoneyRequestStatus extends Enum
{
    const ACCEPTED = 1;
    const DECLINED = 0;
    const CONSIDER = 2;
}