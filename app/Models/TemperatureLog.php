<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\TemperatureLog
 *
 * @property integer $id
 * @property integer $inpatient_id
 * @property string $date
 * @property float $temperature_value
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $inpatient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereTemperatureValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\TemperatureLog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TemperatureLog extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'temperature_log';

    protected $guarded = ['id'];

    protected $fillable = [
        'date', 'temperature_value', 'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
