<?php


namespace App\Common\Enums;

use App\Common\Enum;


class UserRole extends Enum
{
    const department_chief = 'Заведующий отделением';
    const medical_nurse = 'Медсестра';
    const doctor = 'Врач';

    const values = array(
        'Заведующий отделением',
        'Медсестра',
        'Врач'
    );
}