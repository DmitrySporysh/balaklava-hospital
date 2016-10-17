<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\ReceivedPatient
 *
 * @property integer $id
 * @property integer $patient_id
 * @property integer $registration_nurse_id
 * @property string $received_date
 * @property string $fio
 * @property string $work_place
 * @property string $residential_address
 * @property string $registration_address
 * @property string $phone
 * @property string $complaints
 * @property string $received_type
 * @property integer $inspection_protocol_id
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\InspectionProtocol $inspection_protocol
 * @property-read \App\Models\Patient $patient
 * @property-read \App\Models\HealthWorker $registration_nurse
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Inpatient[] $inpatients
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient wherePatientId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereRegistrationNurseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereReceivedDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereFio($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereWorkPlace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereResidentialAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereRegistrationAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereComplaints($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereReceivedType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereInspectionProtocolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ReceivedPatient extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'received_patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'patient_id', 'registration_nurse_id', 'received_date', 'fio', 'work_place',
        'residential_address', 'registration_address', 'phone', 'complaints', 'received_type',
        'inspection_protocol_id'
    ];


    //----belongs to----
    public function inspection_protocol(){
        return $this->belongsTo('App\Models\InspectionProtocol');
    }

    public function patient(){
        return $this->belongsTo('App\Models\Patient');
    }

    public function registration_nurse(){
        return $this->belongsTo('App\Models\HealthWorker');
    }

    //----has many-----------
    public function inpatients(){
        return $this->hasMany('App\Models\Inpatient','received_patient_id');
    }

}
