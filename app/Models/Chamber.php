<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chamber extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'chambers';

    protected $guarded = ['id'];

    protected $fillable = [
        'chamber_sex', 'number', 'floor', 'hospital_department_id'];

    public function beds(){
        return $this->hasMany('App\Models\Bed','chamber_id');
    }

    public function hospital_department(){
        return $this->belongsTo('App\Models\Hospital_department');
    }
}
