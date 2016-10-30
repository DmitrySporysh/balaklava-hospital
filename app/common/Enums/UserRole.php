<?php


namespace App\Common\Enums;

use App\Common\Enum;


class UserRole extends Enum
{
    const values = array(
        'Заведующий отделением',
        'Медсестра',
        'Врач',
        'Мед персонал'
    );
}