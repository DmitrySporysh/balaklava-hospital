<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
