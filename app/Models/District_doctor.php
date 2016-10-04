<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\District_doctor
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
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereFio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereHospitalId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\District_doctor whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class District_doctor extends Model
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

    public function patients(){
        return $this->hasMany('App\Models\Patient', 'district_doctor_id');
    }
}
