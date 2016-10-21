<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\DistrictDoctor
 *
 * @property integer $id
 * @property string $fio
 * @property string $address
 * @property string $birth_date
 * @property string $description
 * @property integer $hospital_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Hospital $hospital
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Patient[] $patients
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereFio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereHospitalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\DistrictDoctor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class DistrictDoctor extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'district_doctors';

    protected $guarded = ['id'];

    protected $fillable = [
        'fio', 'address', 'birth_date', 'description',
        'hospital_id' ];

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital');
    }

    public function inpatients(){
        return $this->hasMany('App\Models\Inpatient', 'district_doctor_id');
    }
}
