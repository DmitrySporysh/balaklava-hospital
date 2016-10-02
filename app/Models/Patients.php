<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patients extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'patients';

    protected $guarded = ['id'];

    protected $fillable = [
        'fio', 'sex', 'birth_date', 'receipt_date', 'initial_inspection', 'preliminary_diagnosis', 'initial_inspection'
    ];
}
