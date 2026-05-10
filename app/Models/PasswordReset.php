<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 *
 * @property int $id
 * @property string $email
 * @property string $token
 * @property \Carbon\Carbon $created_at
 */
class PasswordReset extends Model
{
    public $timestamps = false;

    protected $hidden = [
        'token',
    ];

    protected $fillable = [
        'email',
        'token',
    ];
}
