<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Bed
 *
 * @property integer $id
 * @property integer $chamber_id
 * @property integer $patient_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\Chamber $chamber
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bed whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bed whereChamberId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bed wherePatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bed whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bed whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Bed whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Bed extends Model
{
    /*use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'beds';

    protected $guarded = ['id'];

    protected $fillable = [
        'bed_number', 'chamber_id', 'patient_id'];

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id');
    }

    public function chamber(){
        return $this->belongsTo('App\Models\Chamber');
    }*/
}
