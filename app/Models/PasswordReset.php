<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PasswordReset extends Model
{
    protected $fillable =  ['email', 'token'];
    protected $hidden = ['token'];
    protected $table = 'password_resets';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    //Relationships
}
