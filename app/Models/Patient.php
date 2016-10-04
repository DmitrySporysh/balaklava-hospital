<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'fio', 'sex', 'birth_date', 'receipt_date',
        'initial_inspection', 'preliminary_diagnosis', 'confirmed_diagnosis',
        'district_doctor_id', 'attending_doctor_id', 'hospital_department_id', 'bed_id'
    ];

    //-------has one------
    public function bed()
    {
        return $this->hasOne('App\Models\Bed', 'patient_id');
    }

    public function discharge()
    {
        return $this->hasOne('App\Models\Discharge', 'patient_id');
    }

    //----belongs to----
    public function district_doctors(){
        return $this->belongsTo('App\Models\District_doctor');
    }

    public function attending_doctor(){
        return $this->belongsTo('App\Models\Health_worker');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\Hospital_department');
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
