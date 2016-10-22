<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\Inspection
 *
 * @property integer $id
 * @property string $inspection_date
 * @property string $state_type
 * @property string $description_extended
 * @property integer $inpatient_id
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $inpatient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereInspectionDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereStateType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereDescriptionExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Inspection whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Inspection extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inspections';

    protected $guarded = ['id'];

    protected $fillable = [
        'inspection_date', 'state_type', 'description_extended', 'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
