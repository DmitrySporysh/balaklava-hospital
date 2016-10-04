<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Health_worker extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'health_workers';

    protected $guarded = ['id'];

    protected $fillable = [
        'fio', 'name', 'address', 'birth_date',
        'post', 'description'
    ];

    public function hospital_department()
    {
        return $this->hasOne('App\Models\Hospital_department', 'department_chief_id');
    }

    public function patients(){
        return $this->hasMany('App\Models\Patient','attending_doctor_id');
    }

    public function inspections(){
        return $this->hasMany('App\Models\Inspection','doctor_id');
    }

    public function dressings(){
        return $this->hasMany('App\Models\Dressing','doctor_id');
    }

    public function operations(){
        return $this->hasMany('App\Models\Operation','doctor_id');
    }

    public function surveys(){
        return $this->hasMany('App\Models\Survey','doctor_id');
    }

    public function treatments(){
        return $this->hasMany('App\Models\Treatment','doctor_id');
    }
}
