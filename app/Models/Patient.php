<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



/**
 * App\Models\Patient
 *
 * @property integer $id
 * @property integer $insurance_number
 * @property string $sex
 * @property string $birth_date
 * @property string $blood_type
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ReceivedPatient[] $received_patients
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereInsuranceNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereSex($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereBirthDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereBloodType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Patient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Patient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'insurance_number', 'sex', 'birth_date', 'blood_type'
    ];

    //----has many-----------

    public function received_patients(){
        return $this->hasMany('App\Models\ReceivedPatient','patient_id');
    }
}
