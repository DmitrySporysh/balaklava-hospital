<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Inspection extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inspections';

    protected $guarded = ['id'];

    protected $fillable = [
        'inspection_date', 'state_type', 'description_extended', 'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
