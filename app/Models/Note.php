<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'notes';

    protected $guarded = ['id'];

    protected $fillable = [
        'health_worker_id', 'date', 'topic', 'text'
    ];

    public function health_worker(){
        return $this->belongsTo('App\Models\HealthWorker');
    }
}
