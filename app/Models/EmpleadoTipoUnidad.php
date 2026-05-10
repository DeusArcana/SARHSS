<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoTipoUnidad
 *
 * @property int $ID_Empleado_Tipo_Unidad
 * @property int $ID_Tipo_Unidad
 * @property int $ID_Servicio_Puesto
 * @property int $Cantidad
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\ServicioPuesto $servicio_puesto
 * @property \App\Models\TipoUnidad $tipo_unidad
 */
class EmpleadoTipoUnidad extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Empleado_Tipo_Unidad';

    protected $primaryKey = 'ID_Empleado_Tipo_Unidad';

    public $timestamps = false;

    protected $casts = [
        'ID_Tipo_Unidad' => 'int',
        'ID_Servicio_Puesto' => 'int',
        'Cantidad' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'ID_Tipo_Unidad',
        'ID_Servicio_Puesto',
        'Cantidad',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function servicio_puesto()
    {
        return $this->belongsTo(\App\Models\ServicioPuesto::class, 'ID_Servicio_Puesto');
    }

    public function tipo_unidad()
    {
        return $this->belongsTo(\App\Models\TipoUnidad::class, 'ID_Tipo_Unidad');
    }
}
