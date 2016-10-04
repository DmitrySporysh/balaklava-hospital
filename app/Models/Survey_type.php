<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Survey_type
 *
 * @property integer $id
 * @property string $survey_name
 * @property string $description
 * @property string $room_number
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Survey[] $surveys
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereSurveyName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereRoomNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Survey_type whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Survey_type extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'surveys_types';

    protected $guarded = ['id'];

    protected $fillable = [
        'survey_name', 'description', 'room_number'
    ];

    public function surveys(){
        return $this->hasMany('App\Models\Survey','survey_type_id');
    }
}
