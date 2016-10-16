<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceivedPatient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'received_patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'patient_id', 'registration_nurse_id', 'received_date', 'fio', 'work_place',
        'residential_address', 'registration_address', 'phone', 'complaints', 'received_type',
        'inspection_protocol_id'
    ];


    //----belongs to----
    public function inspection_protocol(){
        return $this->belongsTo('App\Models\InspectionProtocol');
    }

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }

    public function registration_nurse(){
        return $this->belongsTo('App\Models\HealthWorker');
    }

    //----has many-----------
    public function inpatients(){
        return $this->hasMany('App\Models\Inpatient','received_patient_id');
    }

}
