<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InspectionProtocol extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'inspections_protocols';

    protected $guarded = ['id'];

    protected $fillable = [

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
