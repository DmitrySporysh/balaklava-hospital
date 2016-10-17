<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\SurveyType
 *
 * @property integer $id
 * @property string $survey_type_name
 * @property string $description
 * @property string $room_number
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Survey[] $surveys
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereSurveyTypeName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereRoomNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\SurveyType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SurveyType extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'surveys_types';

    protected $guarded = ['id'];

    protected $fillable = [
        'survey_type_name', 'description', 'room_number'
    ];

    public function surveys(){
        return $this->hasMany('App\Models\Survey','survey_type_id');
    }
}
