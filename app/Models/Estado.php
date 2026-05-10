<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Estado
 *
 * @property int $ID_Estado
 * @property string $Nombre
 * @property string $Clave_RENAPO
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $jurisdiccions
 */
class Estado extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Estado';

    protected $primaryKey = 'ID_Estado';

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
        'Nombre',
        'Clave_RENAPO',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function jurisdiccions()
    {
        return $this->hasMany(\App\Models\Jurisdiccion::class, 'Estado');
    }
}
