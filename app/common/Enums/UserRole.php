<?php


namespace App\Common\Enums;

use App\Common\Enum;


class UserRole extends Enum
{
    const DEPARTMENT_CHIEF = 'Заведующий отделением';
    const NURSE = 'Медсестра';
    const DOCTOR = 'Врач';

    const values = array(
        'Заведующий отделением',
        'Медсестра',
        'Врач'
    );
}