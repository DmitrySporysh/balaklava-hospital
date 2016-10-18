<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\InspectionProtocol
 *
 * @property integer $id
 * @property integer $duty_doctor_id
 * @property string $date
 * @property string $complaints
 * @property string $from_anamnesis
 * @property string $in_anamnesis
 * @property string $insurance_anamnesis
 * @property string $allergoanamnez
 * @property string $condition
 * @property string $consciousness
 * @property string $body_type
 * @property string $food
 * @property string $skin
 * @property string $turgor
 * @property string $pupils
 * @property string $tongue
 * @property string $tongue_extended
 * @property string $auscultation
 * @property string $auscultation_extended
 * @property string $percussion_sound
 * @property string $heart_tones
 * @property string $heart_rhythm
 * @property string $heart_rhythm_extended
 * @property string $respiratory_movements_frequency_ChDD
 * @property string $heart_rate_ChSS
 * @property string $heart_boundaries
 * @property string $heart_boundaries_extended
 * @property string $muscle_tone
 * @property string $muscle_tone_extended
 * @property string $joint_motion
 * @property string $stomach_density
 * @property string $stomach_pain
 * @property string $stomach_extended
 * @property string $in_romberg_position
 * @property string $gait
 * @property string $gait_extended
 * @property string $stools
 * @property string $stools_extended
 * @property string $stools_consistency
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\HealthWorker $duty_doctor
 * @property-read \App\Models\ReceivedPatient $received_patient
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereDutyDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereComplaints($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereFromAnamnesis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereInAnamnesis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereInsuranceAnamnesis($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereAllergoanamnez($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereCondition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereConsciousness($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereBodyType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereFood($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereSkin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereTurgor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol wherePupils($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereTongue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereTongueExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereAuscultation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereAuscultationExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol wherePercussionSound($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereHeartTones($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereHeartRhythm($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereHeartRhythmExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereRespiratoryMovementsFrequencyChDD($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereHeartRateChSS($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereHeartBoundaries($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereHeartBoundariesExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereMuscleTone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereMuscleToneExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereJointMotion($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereStomachDensity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereStomachPain($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereStomachExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereInRombergPosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereGait($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereGaitExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereStools($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereStoolsExtended($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereStoolsConsistency($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\InspectionProtocol whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class InspectionProtocol extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inspections_protocols';

    protected $guarded = ['id'];

    protected $fillable = [
        'duty_doctor_id', 'date', 'complaints', 'from_anamnesis', 'in_anamnesis', 'insurance_anamnesis',
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
