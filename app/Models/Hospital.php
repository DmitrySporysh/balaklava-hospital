<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Hospital
 *
 * @property integer $id
 * @property string $hospital_name
 * @property string $address
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\District_doctor[] $district_doctors
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Discharge[] $discharges
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hospital whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hospital whereHospitalName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hospital whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hospital whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hospital whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Hospital whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
