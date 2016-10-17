<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Treatment
 *
 * @property integer $id
 * @property string $treatment_name
 * @property string $description
 * @property string $date
 * @property integer $inpatient_id
 * @property integer $doctor_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Inpatient $patient
 * @property-read \App\Models\HealthWorker $doctor
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereTreatmentName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereInpatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Treatment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Treatment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'treatments';

    protected $guarded = ['id'];

    protected $fillable = [
        'treatment_name', 'description', 'date', 'patient_id', 'doctor_id'];

    public function patient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
