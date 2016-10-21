<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Analysis extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'analyzes';

    protected $guarded = ['id'];

    protected $fillable = [
        'appointment_date', 'ready_date', 'analysis_name',
        'analysis_description', 'result_description', 'paths_to_files',
        'patient_id', 'doctor_id', 'status'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
