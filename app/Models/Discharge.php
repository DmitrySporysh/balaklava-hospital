<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Discharge
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $discharge_date
 * @property string $result_epicrisis
 * @property string $discharge_type
 * @property integer $patient_id
 * @property integer $discharge_hospital_id
 * @property integer $discharge_department_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Hospital $hospital
 * @property-read \App\Models\HospitalDepartment $hospital_department
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereDischargeDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereResultEpicrisis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereDischargeType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge wherePatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereDischargeHospitalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereDischargeDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Discharge whereUpdatedAt($value)
 */
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
        return $this->belongsTo('App\Models\Inpatient', 'patient_id');
    }

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\HospitalDepartment');
    }
}
