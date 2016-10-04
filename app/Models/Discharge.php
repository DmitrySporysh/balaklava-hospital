<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discharge extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'discharges';

    protected $guarded = ['id'];

    protected $fillable = [
        'discharge_date', 'result_epicrisis', 'discharge_type', 'patient_id',
        'discharge_hospital_id', 'discharge_department_id'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id');
    }

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\Hospital_department');
    }
}
