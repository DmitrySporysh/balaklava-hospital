<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Dressing
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $dressing_date
 * @property string $dressing_name
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereDressingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereDressingName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing wherePatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Dressing whereUpdatedAt($value)
 */
class Dressing extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'dressings';

    protected $guarded = ['id'];

    protected $fillable = [
        'dressing_date', 'dressing_name', 'patient_id', 'doctor_id'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
