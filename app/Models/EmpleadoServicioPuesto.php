<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoServicioPuesto
 *
 * @property int $ID_Empleado_Servicio_Puesto
 * @property int $Empleado
 * @property bool $Estandar
 * @property int $Servicio_Puesto
 * @property int $Servicio
 * @property int $Puesto
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 * @property \App\Models\Puesto $puesto
 * @property \App\Models\Servicio $servicio
 * @property \App\Models\ServicioPuesto $servicio_puesto
 */
class EmpleadoServicioPuesto extends Model
{
    protected $table = 'Empleado_Servicio_Puesto';

    protected $primaryKey = 'ID_Empleado_Servicio_Puesto';

    public $timestamps = false;

    protected $casts = [
        'Empleado' => 'int',
        'Estandar' => 'bool',
        'Servicio_Puesto' => 'int',
        'Servicio' => 'int',
        'Puesto' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Empleado',
        'Estandar',
        'Servicio_Puesto',
        'Servicio',
        'Puesto',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado');
    }

    public function puesto()
    {
        return $this->belongsTo(\App\Models\Puesto::class, 'Puesto');
    }

    public function servicio()
    {
        return $this->belongsTo(\App\Models\Servicio::class, 'Servicio');
    }

    public function servicio_puesto()
    {
        return $this->belongsTo(\App\Models\ServicioPuesto::class, 'Servicio_Puesto');
    }
}
