<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Analysis
 *
 * @property integer $id
 * @property integer $inpatient_id
 * @property integer $doctor_who_appointed
 * @property integer $doctor_who_performed
 * @property string $appointment_date
 * @property string $ready_date
 * @property string $analysis_name
 * @property string $analysis_description
 * @property string $result_description
 * @property string $paths_to_files
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $patient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereDoctorWhoAppointed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereDoctorWhoPerformed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereAppointmentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereReadyDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereAnalysisName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereAnalysisDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereResultDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis wherePathsToFiles($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Analysis whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Analysis extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'analyzes';

    protected $guarded = ['id'];

    protected $fillable = [
        'appointment_date', 'ready_date', 'analysis_name',
        'analysis_description', 'result_description', 'paths_to_files',
        'inpatient_id', 'doctor_who_appointed', 'doctor_who_performed'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
