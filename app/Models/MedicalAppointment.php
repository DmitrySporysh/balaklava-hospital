<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\MedicalAppointment
 *
 * @property integer $id
 * @property string $date
 * @property string $description
 * @property integer $inpatient_id
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $inpatient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MedicalAppointment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MedicalAppointment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'medical_appointments';

    protected $guarded = ['id'];

    protected $fillable = [
        'description', 'date', 'inpatient_id', 'doctor_id'];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
