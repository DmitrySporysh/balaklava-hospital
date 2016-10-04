<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bed extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'beds';

    protected $guarded = ['id'];

    protected $fillable = [
        'bed_number', 'chamber_id', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id');
    }

    public function chamber(){
        return $this->belongsTo('App\Models\Chamber');
    }
}
