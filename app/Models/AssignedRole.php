<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AssignedRole
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class AssignedRole extends Model
{
    protected $casts = [
        'user_id' => 'int',
        'role_id' => 'int',
    ];

    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
