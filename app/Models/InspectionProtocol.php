<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionProtocol extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inspections_protocols';

    protected $guarded = ['id'];

    protected $fillable = [
        'duty_doctor_id', 'date', 'from_anamnesis', 'in_anamnesis', 'insurance_anamnesis',
        'allergoanamnez', 'condition', 'consciousness', 'body_type', 'food', 'skin', 'turgor', 'pupils',
        'tongue', 'auscultation', 'auscultation_extended', 'percussion_sound', 'heart_tones', 'heart_rhythm',
        'heart_rhythm_extended', 'respiratory_movements_frequency_ChDD', 'heart_rate_ChSS', 'heart_boundaries',
        'heart_boundaries_extended', 'muscle_tone', 'muscle_tone_extended', 'joint_motion', 'stomach_density',
        'stomach_pain', 'stomach_extended', 'in_romberg_position', 'gait', 'gait_extended', 'stools',
        'stools_extended', 'stools_consistency'
    ];


    public function duty_doctor()
    {
        return $this->belongsTo('App\Models\HealthWorker');
    }

    public function received_patient()
    {
        return $this->hasOne('App\Models\ReceivedPatient', 'inspection_protocol_id');
    }
}
