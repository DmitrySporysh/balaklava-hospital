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
        'patient_id', 'doctor_id'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\Health_worker');
    }
}
