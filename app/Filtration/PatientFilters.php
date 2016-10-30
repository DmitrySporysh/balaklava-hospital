<?php
namespace App\Filtration;

use Illuminate\Database\Eloquent\Builder;

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
        if (trim($fio) !== '')
            return $this->builder->where('fio', 'LIKE', trim($fio . '%'));
    }

    /**
     * Filter by difficulty.
     *
     * @param  integer $inpatient_number
     * @return Builder
     */
   /* public function inpatient_number($inpatient_number = null)
    {
        return $this->builder->with('inpatients' => function ($query)
    {
        $query->where('inpatients.id', '=', $inpatient_number);
    });
    }*/

    /**
     * Filter by length.
     *
     * @param  integer $insurance_number
     * @return Builder
     */
    public function insurance_number($insurance_number = null)
    {
        return $this->builder->where('insurance_number', $insurance_number);
    }

    /**
     * Filter by sex.
     *
     * @param  string $sex
     * @return Builder
     */
    public function sex($sex = null)
    {
        if (trim($sex) !== '')
            return $this->builder->where('sex', 'LIKE', trim($sex . '%'));
    }


}