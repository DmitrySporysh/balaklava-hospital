<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Procedure extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'procedures';

    protected $guarded = ['id'];

    protected $fillable = [
        'procedure_date', 'procedure_name', 'procedure_description', 'inpatient_id', 'doctor_id'
    ];

    public function inpatient(){
        return $this->belongsTo('App\Models\Inpatient');
    }

    public function doctor(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
