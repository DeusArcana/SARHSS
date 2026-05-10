<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoTurno
 *
 * @property int $ID_Empleado_Turno
 * @property int $Empleado_ID_Empleado
 * @property int $Turno_ID_Turno
 * @property \Carbon\Carbon $Fecha_Inicio
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 * @property \App\Models\Turno $turno
 */
class EmpleadoTurno extends Model
{
    protected $table = 'Empleado_Turno';

    protected $primaryKey = 'ID_Empleado_Turno';

    public $timestamps = false;

    protected $casts = [
        'Empleado_ID_Empleado' => 'int',
        'Turno_ID_Turno' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'Fecha_Inicio',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Empleado_ID_Empleado',
        'Turno_ID_Turno',
        'Fecha_Inicio',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado_ID_Empleado');
    }

    public function turno()
    {
        return $this->belongsTo(\App\Models\Turno::class, 'Turno_ID_Turno');
    }
}
