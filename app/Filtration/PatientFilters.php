<?php
namespace App\Filtration;

use Illuminate\Database\Query\Builder;
use Barryvdh\Debugbar\Facade;
use Debugbar;

class PatientFilters extends QueryFilters
{
    /**
     * Filter by popularity.
     *
     * @param  string $fio
     * @return Builder
     */
    public function fio($fio = null)
    {
        if ($fio && trim($fio) !== '')
            return $this->builder->where('fio', 'LIKE', trim('%' . $fio . '%'));
    }

    /**
     * Filter by difficulty.
     *
     * @param  integer $inpatient_number
     * @return Builder
     */
    public function inpatient_number($inpatient_number = null)
    {
        if ($inpatient_number)
            return $this->builder->where('inpatients.id', '=', $inpatient_number);
    }

    /**
     * Filter by length.
     *
     * @param  integer $insurance_number
     * @return Builder
     */

    public function insurance_number($insurance_number = null)
    {
        if ($insurance_number)
            return $this->builder->where('patients.insurance_number', '=', $insurance_number);
    }

    /**
     * Filter by sex.
     *
     * @param  string $sex
     * @return Builder
     */

    public function sex($sex = null)
    {
        if ($sex)
            return $this->builder->where('patients.sex', 'LIKE', trim($sex . '%'));
    }


}