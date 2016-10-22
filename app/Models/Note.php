<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Note
 *
 * @property integer $id
 * @property integer $health_worker_id
 * @property string $date
 * @property string $topic
 * @property string $text
 * @property \Carbon\Carbon $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\HealthWorker $health_worker
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereHealthWorkerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereTopic($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Note whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
