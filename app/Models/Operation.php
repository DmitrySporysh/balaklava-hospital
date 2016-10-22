<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Operation
 *
 * @property integer $id
 * @property string $operation_date
 * @property string $operation_name
 * @property string $preliminary_epicrisis
 * @property string $result
 * @property integer $inpatient_id
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $inpatient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereOperationDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereOperationName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation wherePreliminaryEpicrisis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereResult($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Operation whereDoctorId($value)
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
        'operation_date', 'operation_name', 'preliminary_epicrisis', 'result',
        'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
