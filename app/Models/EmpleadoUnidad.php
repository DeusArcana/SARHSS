<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoUnidad
 *
 * @property int $ID_Empleado_Unidad
 * @property int $Empleado_ID_Empleado
 * @property int $Unidad_Fisica
 * @property int $Unidad_Adscripcion
 * @property string $Estado_Adscripcion
 * @property string $Numero_Oficio
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 * @property \App\Models\Unidad $unidad
 */
class EmpleadoUnidad extends Model
{
    protected $table = 'Empleado_Unidad';

    protected $primaryKey = 'ID_Empleado_Unidad';

    public $timestamps = false;

    protected $casts = [
        'Empleado_ID_Empleado' => 'int',
        'Unidad_Fisica' => 'int',
        'Unidad_Adscripcion' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Empleado_ID_Empleado',
        'Unidad_Fisica',
        'Unidad_Adscripcion',
        'Estado_Adscripcion',
        'Numero_Oficio',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado_ID_Empleado');
    }

    public function unidad()
    {
        return $this->belongsTo(\App\Models\Unidad::class, 'Unidad_Fisica');
    }
}
