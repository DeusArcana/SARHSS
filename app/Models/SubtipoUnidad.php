<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class SubtipoUnidad
 *
 * @property int $ID_Subtipo_Unidad
 * @property string $Clave
 * @property string $Subtipo_Unidad
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $unidads
 */
class SubtipoUnidad extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Subtipo_Unidad';

    protected $primaryKey = 'ID_Subtipo_Unidad';

    public $timestamps = false;

    protected $casts = [
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Clave',
        'Subtipo_Unidad',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function unidads()
    {
        return $this->hasMany(\App\Models\Unidad::class, 'Subtipo_Unidad');
    }
}
