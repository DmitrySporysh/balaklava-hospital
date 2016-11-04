<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Operation
 *
 * @property integer $id
 * @property integer $inpatient_id
 * @property integer $doctor_who_appointed
 * @property integer $doctor_who_performed
 * @property string $appointment_date
 * @property string $operation_date
 * @property string $operation_name
 * @property string $preliminary_epicrisis
 * @property string $operation_description
 * @property string $result
 * @property string $paths_to_files
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $inpatient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereDoctorWhoAppointed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereDoctorWhoPerformed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereAppointmentDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereOperationDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereOperationName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation wherePreliminaryEpicrisis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereOperationDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereResult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation wherePathsToFiles($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Operation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'operations';

    protected $guarded = ['id'];

    protected $fillable = [
        'appointment_date', 'operation_date', 'operation_name',
        'preliminary_epicrisis', 'operation_description', 'result',
        'inpatient_id', 'doctor_who_appointed', 'doctor_who_performed', 'paths_to_files'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
