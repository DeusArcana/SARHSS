<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PeriodoTurno
 *
 * @property int $ID_Periodo_Turno
 * @property int $Turno
 * @property \Carbon\Carbon $Hora_Entrada
 * @property \Carbon\Carbon $Hora_Salida
 * @property float $Horas_Jornada
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Turno $turno
 */
class PeriodoTurno extends Model
{
    protected $table = 'Periodo_Turno';

    protected $primaryKey = 'ID_Periodo_Turno';

    public $timestamps = false;

    protected $casts = [
        'Turno' => 'int',
        'Horas_Jornada' => 'float',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'Hora_Entrada',
        'Hora_Salida',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Turno',
        'Hora_Entrada',
        'Hora_Salida',
        'Horas_Jornada',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function turno()
    {
        return $this->belongsTo(\App\Models\Turno::class, 'Turno');
    }
}
