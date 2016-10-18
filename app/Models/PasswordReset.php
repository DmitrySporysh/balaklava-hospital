<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PasswordReset
 *
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\PasswordReset whereCreatedAt($value)
 * @mixin \Eloquent
 */
class PasswordReset extends Model
{
    protected $fillable =  ['email', 'token'];
    protected $hidden = ['token'];
    protected $table = 'password_resets';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    //Relationships
}
