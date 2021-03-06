<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\HospitalDepartment
 *
 * @property integer $id
 * @property string $department_name
 * @property string $address
 * @property integer $department_chief_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Chamber[] $chambers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\HealthWorker[] $health_workers
 * @property-read \App\Models\HealthWorker $department_chief
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inpatient[] $inpatients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Discharge[] $discharges
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereDepartmentName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereDepartmentChiefId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\HospitalDepartment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HospitalDepartment extends Model
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

    public function health_workers(){
        return $this->hasMany('App\Models\HealthWorker','department_id');
    }

    public function department_chief()
    {
        return $this->belongsTo('App\Models\HealthWorker');
    }

    public function inpatients(){
        return $this->hasMany('App\Models\Inpatient','hospital_department_id');
    }
    
    public function discharges(){
        return $this->hasMany('App\Models\Discharge','discharge_department_id');
    }

}
