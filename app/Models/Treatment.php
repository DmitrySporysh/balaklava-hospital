<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'treatments';

    protected $guarded = ['id'];

    protected $fillable = [
        'treatment_name', 'description', 'date', 'patient_id', 'doctor_id'];

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\Health_worker');
    }
}
