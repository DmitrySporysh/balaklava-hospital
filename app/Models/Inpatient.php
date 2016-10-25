<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Inpatient
 *
 * @property integer $id
 * @property string $start_date
 * @property string $diagnosis
 * @property integer $received_patient_id
 * @property integer $district_doctor_id
 * @property integer $attending_doctor_id
 * @property integer $hospital_department_id
 * @property integer $chamber_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Discharge $discharge
 * @property-read \App\Models\ReceivedPatient $received_patient
 * @property-read \App\Models\DistrictDoctor $district_doctor
 * @property-read \App\Models\HealthWorker $attending_doctor
 * @property-read \App\Models\HospitalDepartment $hospital_department
 * @property-read \App\Models\Chamber $chamber
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Operation[] $operations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Procedure[] $procedures
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inspection[] $inspection
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MedicalAppointment[] $medical_appointments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Analysis[] $analyzes
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereStartDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereDiagnosis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereReceivedPatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereDistrictDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereAttendingDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereHospitalDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereChamberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inpatient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
        return $this->hasOne('App\Models\Discharge', 'inpatient_id');
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
        return $this->hasMany('App\Models\Operation','inpatient_id');
    }

    public function procedures(){
        return $this->hasMany('App\Models\Procedure','inpatient_id');
    }

    public function inspection(){
        return $this->hasMany('App\Models\Inspection','inpatient_id');
    }

    public function medical_appointments(){
        return $this->hasMany('App\Models\MedicalAppointment','inpatient_id');
    }

    public function analyzes(){
        return $this->hasMany('App\Models\Analysis','inpatient_id');
    }
}
