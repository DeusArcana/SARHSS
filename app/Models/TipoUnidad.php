<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TipoUnidad
 *
 * @property int $ID_Tipo_Unidad
 * @property string $Clave
 * @property string $Tipo_Unidad
 * @property string $Categoria
 * @property string $Observaciones
 * @property string $Nivel
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleado__tipo__unidads
 * @property \Illuminate\Database\Eloquent\Collection $unidads
 */
class TipoUnidad extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Tipo_Unidad';

    protected $primaryKey = 'ID_Tipo_Unidad';

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
        'Tipo_Unidad',
        'Categoria',
        'Observaciones',
        'Nivel',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado__tipo__unidads()
    {
        return $this->hasMany(\App\Models\EmpleadoTipoUnidad::class, 'ID_Tipo_Unidad');
    }

    public function unidads()
    {
        return $this->hasMany(\App\Models\Unidad::class, 'Tipo_Unidad');
    }
}
