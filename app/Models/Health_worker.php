<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Health_worker
 *
 * @property integer $id
 * @property string $fio
 * @property string $name
 * @property string $address
 * @property string $birth_date
 * @property string $post
 * @property string $description
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Hospital_department $hospital_department
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inspection[] $inspections
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Dressing[] $dressings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Operation[] $operations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Survey[] $surveys
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Treatment[] $treatments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereFio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker wherePost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Health_worker whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
