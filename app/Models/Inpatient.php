<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Inpatient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inpatients';

    protected $guarded = ['id'];

    protected $fillable = [
        'start_date', 'diagnosis', 'received_patient_id',
        'district_doctor_id', 'attending_doctor_id', 'hospital_department_id', 'chamber_id'
    ];

    //-------has one------

    public function discharge()
    {
        return $this->hasOne('App\Models\Discharge', 'patient_id');
    }

    //----belongs to----
    public function received_patient(){
        return $this->belongsTo('App\Models\ReceivedPatient');
    }

    public function district_doctor(){
        return $this->belongsTo('App\Models\DistrictDoctor');
    }

    public function attending_doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\HospitalDepartment');
    }

    public function chamber(){
        return $this->belongsTo('App\Models\Chamber');
    }
    //----has many-----------

    public function operations(){
        return $this->hasMany('App\Models\Operation','patient_id');
    }

    public function dressings(){
        return $this->hasMany('App\Models\Dressing','patient_id');
    }

    public function inspection(){
        return $this->hasMany('App\Models\Inspection','patient_id');
    }

    public function treatments(){
        return $this->hasMany('App\Models\Treatment','patient_id');
    }

    public function surveys(){
        return $this->hasMany('App\Models\Survey','patient_id');
    }
}
