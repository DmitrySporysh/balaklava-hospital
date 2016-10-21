<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Operation extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'operations';

    protected $guarded = ['id'];

    protected $fillable = [
        'operation_date', 'operation_name', 'preliminary_epicrisis', 'result',
        'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
