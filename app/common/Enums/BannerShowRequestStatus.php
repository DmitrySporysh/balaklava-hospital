<?php


namespace App\Common\Enums;
use App\Common\Enum;

class BannerShowRequestStatus extends Enum
{
  const ACCEPTED = 1;
  const DECLINED = 0;
  const UNTREATED = 2;
  const COMPLETED = 3;
}