<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Patient
 *
 * @property integer $id
 * @property string $fio
 * @property string $sex
 * @property string $birth_date
 * @property string $receipt_date
 * @property string $initial_inspection
 * @property string $preliminary_diagnosis
 * @property string $confirmed_diagnosis
 * @property integer $district_doctor_id
 * @property integer $attending_doctor_id
 * @property integer $hospital_department_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Bed $bed
 * @property-read \App\Models\Discharge $discharge
 * @property-read \App\Models\District_doctor $district_doctors
 * @property-read \App\Models\Health_worker $attending_doctor
 * @property-read \App\Models\Hospital_department $hospital_department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Operation[] $operations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dressing[] $dressings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inspection[] $inspection
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Treatment[] $treatments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Survey[] $surveys
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereFio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereReceiptDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereInitialInspection($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient wherePreliminaryDiagnosis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereConfirmedDiagnosis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereDistrictDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereAttendingDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereHospitalDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'fio', 'sex', 'birth_date', 'receipt_date',
        'initial_inspection', 'preliminary_diagnosis', 'confirmed_diagnosis',
        'district_doctor_id', 'attending_doctor_id', 'hospital_department_id', 'chamber_id'
    ];

    //-------has one------

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
