<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class HealthWorker extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'health_workers';

    protected $guarded = ['id'];

    protected $fillable = [
        'fio', 'name', 'address', 'birth_date',
        'post', 'description', 'login_id'
    ];

    //belongs to
    public function department_chief()
    {
        return $this->belongsTo('App\Models\User');
    }

    //has one
    public function hospital_department()
    {
        return $this->hasOne('App\Models\HospitalDepartment', 'department_chief_id');
    }

    //has many
    public function inpatients(){
        return $this->hasMany('App\Models\Inpatient','attending_doctor_id');
    }

    public function inspections_protocols(){
        return $this->hasMany('App\Models\InspectionProtocol','duty_doctor_id');
    }

    public function received_patients(){
        return $this->hasMany('App\Models\ReceivedPatient','registration_nurse_id');
    }

    public function inspections(){
        return $this->hasMany('App\Models\Inspection','doctor_id');
    }

    public function dressings(){
        return $this->hasMany('App\Models\Dressing','doctor_id');
    }

    public function operations(){
        return $this->hasMany('App\Models\Operation','doctor_id');
    }

    public function analyzes(){
        return $this->hasMany('App\Models\Analysis','doctor_id');
    }

    public function medical_appointments(){
        return $this->hasMany('App\Models\MedicalAppointment','doctor_id');
    }

    public function notes(){
        return $this->hasMany('App\Models\Note','health_worker_id');
    }
}
