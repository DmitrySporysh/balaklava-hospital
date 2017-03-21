<?php

namespace App\Models;

use App\Filtration;
use App\Filtration\Filterable;
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
 * @property string $marital_status
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereMaritalStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient filter($filters)
 * @property string $education
 * @property string $policy_oms
 * @property string $medical_insurance_company
 * @property string $medical_company_sent
 * @property string $diagnosis_medical_company_sent
 * @property string $diagnosis_complications_medical_company_sent
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereDiagnosisComplicationsMedicalCompanySent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereDiagnosisMedicalCompanySent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereEducation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereMedicalCompanySent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient whereMedicalInsuranceCompany($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ReceivedPatient wherePolicyOms($value)
 */
class ReceivedPatient extends Model
{
    use SoftDeletes;

    use Filterable;

    protected $dates = ['deleted_at'];

    protected $table = 'received_patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'patient_id', 'marital_status', 'registration_nurse_id', 'received_date', 'fio', 'work_place',
        'residential_address', 'registration_address', 'phone', 'complaints', 'received_type',
        'inspection_protocol_id',

        'policy_oms', 'education', 'medical_insurance_company',
        'medical_company_sent', 'diagnosis_medical_company_sent',
        'diagnosis_complications_medical_company_sent'
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
