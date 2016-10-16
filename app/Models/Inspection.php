<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Inspection
 *
 * @property integer $id
 * @mixin \Eloquent
 * @property string $inspection_date
 * @property string $result_text
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereInspectionDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereResultText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection wherePatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereUpdatedAt($value)
 */
class Inspection extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inspections';

    protected $guarded = ['id'];

    protected $fillable = [
        'inspection_date', 'result_text', 'patient_id', 'doctor_id'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
