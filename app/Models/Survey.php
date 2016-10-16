<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Survey
 *
 * @property integer $id
 * @property string $survey_name
 * @property string $survey_date
 * @property boolean $status
 * @property string $result_text
 * @property string $result_file
 * @property integer $patient_id
 * @property integer $doctor_id
 * @property integer $survey_type_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\HealthWorker $doctor
 * @property-read \App\Models\SurveyType $survey_type
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereSurveyName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereSurveyDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereResultText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereResultFile($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey wherePatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereDoctorId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereSurveyTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Survey extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'surveys';

    protected $guarded = ['id'];

    protected $fillable = [
        'survey_name', 'survey_date', 'status',
        'result_text', 'result_file', 'patient_id', 'doctor_id', 'survey_type_id'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }

    public function survey_type(){
        return $this->belongsTo('App\Models\SurveyType');
    }
}
