<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dressing extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'dressings';

    protected $guarded = ['id'];

    protected $fillable = [
        'dressing_date', 'dressing_name', 'patient_id', 'doctor_id'
    ];

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\Health_worker');
    }
}
