<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Procedure
 *
 * @property integer $id
 * @property integer $inpatient_id
 * @property integer $doctor_who_appointed
 * @property integer $doctor_who_performed
 * @property string $appointment_date
 * @property string $ready_date
 * @property string $procedure_name
 * @property string $procedure_description
 * @property string $paths_to_files
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $inpatient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereDoctorWhoAppointed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereDoctorWhoPerformed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereAppointmentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereReadyDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereProcedureName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereProcedureDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure wherePathsToFiles($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Procedure whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Procedure extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'procedures';

    protected $guarded = ['id'];

    protected $fillable = [
        'appointment_date', 'ready_date', 'procedure_name', 'procedure_description', 'inpatient_id', 'doctor_who_appointed', 'doctor_who_performed'
    ];

    public function inpatient()
    {
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor()
    {
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
