<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'hospitals';

    protected $guarded = ['id'];

    protected $fillable = [
        'hospital_name', 'address'
    ];

    public function district_doctors(){
        return $this->hasMany('App\Models\District_doctor','hospital_id');
    }

    public function discharges(){
        return $this->hasMany('App\Models\Discharge','discharge_hospital_id');
    }

}
