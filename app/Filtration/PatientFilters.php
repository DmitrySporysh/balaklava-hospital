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
            return $this->builder->where('patients.insurance_number', 'LIKE', trim($insurance_number . '%'));
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

    public function sort($sort = null)
    {
        if(!$sort)
            return $this->builder->orderBy('received_patients.fio', 'ASC');

        $sortField = explode('_', $sort)[0];
        $sortDirection = strtoupper(explode('_', $sort)[1]);

        switch ($sortField)
        {
            case 'fio': return $this->builder->orderBy('received_patients.fio', $sortDirection);
            case 'insuranceNumber': return $this->builder->orderBy('patients.insurance_number', $sortDirection);
            case 'inpatientNumber': return $this->builder->orderBy('inpatients.id', $sortDirection);
            default: return $this->builder->orderBy('received_patients.fio', 'ASC');
        }
    }


}