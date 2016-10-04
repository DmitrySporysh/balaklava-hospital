<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
