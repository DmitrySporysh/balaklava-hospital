<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class MedicalAppointment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'medical_appointments';

    protected $guarded = ['id'];

    protected $fillable = [
        'description', 'date', 'inpatient_id', 'doctor_id'];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
