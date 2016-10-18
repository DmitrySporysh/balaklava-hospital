<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Models\Chamber
 *
 * @property integer $id
 * @property integer $number
 * @property integer $floor
 * @property integer $beds_total_count
 * @property integer $beds_occupied_count
 * @property string $chamber_sex
 * @property integer $hospital_department_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inpatient[] $inpatients
 * @property-read \App\Models\HospitalDepartment $hospital_department
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereFloor($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereBedsTotalCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereBedsOccupiedCount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereChamberSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereHospitalDepartmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chamber extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'chambers';

    protected $guarded = ['id'];

    protected $fillable = [
        'chamber_sex', 'number', 'floor', 'hospital_department_id', 'beds_total_count'];

    public function inpatients(){
        return $this->hasMany('App\Models\Inpatient','chamber_id');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\HospitalDepartment');
    }
}
