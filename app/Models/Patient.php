<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Patient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'insurance_number', 'sex', 'birth_date'
    ];

    //----has many-----------

    public function received_patients(){
        return $this->hasMany('App\Models\ReceivedPatient','patient_id');
    }
}
