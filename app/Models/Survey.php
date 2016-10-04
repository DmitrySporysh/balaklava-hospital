<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Survey extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'surveys';

    protected $guarded = ['id'];

    protected $fillable = [
        'treatment_name', 'description', 'survey_date', 'status',
        'result_text', 'result_file', 'patient_id', 'doctor_id', 'survey_type_id'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\Health_worker');
    }

    public function survey_type(){
        return $this->belongsTo('App\Models\Survey_type');
    }
}
