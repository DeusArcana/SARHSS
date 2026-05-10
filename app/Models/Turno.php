<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Turno
 *
 * @property int $ID_Turno
 * @property string $Periodo
 * @property bool $Lunes
 * @property bool $Martes
 * @property bool $Miercoles
 * @property bool $Jueves
 * @property bool $Viernes
 * @property bool $Sabado
 * @property bool $Domingo
 * @property bool $Dias_Festivos
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 * @property \Illuminate\Database\Eloquent\Collection $periodo__turnos
 */
class Turno extends Model
{
    protected $table = 'Turno';

    protected $primaryKey = 'ID_Turno';

    public $timestamps = false;

    protected $casts = [
        'Lunes' => 'bool',
        'Martes' => 'bool',
        'Miercoles' => 'bool',
        'Jueves' => 'bool',
        'Viernes' => 'bool',
        'Sabado' => 'bool',
        'Domingo' => 'bool',
        'Dias_Festivos' => 'bool',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Periodo',
        'Lunes',
        'Martes',
        'Miercoles',
        'Jueves',
        'Viernes',
        'Sabado',
        'Domingo',
        'Dias_Festivos',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empleado_Turno', 'Turno_ID_Turno', 'Empleado_ID_Empleado')
            ->withPivot('ID_Empleado_Turno', 'Fecha_Inicio', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function periodo__turnos()
    {
        return $this->hasMany(\App\Models\PeriodoTurno::class, 'Turno');
    }
}
