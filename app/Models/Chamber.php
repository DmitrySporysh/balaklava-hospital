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
 * @property string $chamber_sex
 * @property integer $hospital_department_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Bed[] $beds
 * @property-read \App\Models\Hospital_department $hospital_department
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Chamber whereFloor($value)
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
        'chamber_sex', 'number', 'floor', 'hospital_department_id'];

    public function patients(){
        return $this->hasMany('App\Models\Patient','chamber_id');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\Hospital_department');
    }
}
