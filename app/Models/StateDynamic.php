<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\StateDynamic
 *
 * @property-read \App\Models\HealthWorker $doctor
 * @property-read \App\Models\Inpatient $inpatient
 * @mixin \Eloquent
 * @property int $id
 * @property string $date
 * @property string $description
 * @property string $appointment
 * @property int $inpatient_id
 * @property int $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereAppointment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\StateDynamic whereUpdatedAt($value)
 */
class StateDynamic extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'state_dynamic';

    protected $guarded = ['id'];

    protected $fillable = [
        'date', 'description', 'appointment', 'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
