<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hospital_department extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'hospital_departments';

    protected $guarded = ['id'];

    protected $fillable = [
        'department_name', 'address', 'department_chief_id'];

    public function chambers(){
        return $this->hasMany('App\Models\Chamber','hospital_department_id');
    }

    public function department_chief()
    {
        return $this->belongsTo('App\Models\Health_worker');
    }

    public function patients(){
        return $this->hasMany('App\Models\Patient','hospital_department_id');
    }
    
    public function discharges(){
        return $this->hasMany('App\Models\Discharge','discharge_department_id');
    }

}
