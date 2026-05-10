<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ServicioPuesto
 *
 * @property int $ID_Servicio_Puesto
 * @property int $Puesto_ID_Puesto
 * @property int $Servicio_ID_Servicio
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Puesto $puesto
 * @property \App\Models\Servicio $servicio
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 * @property \Illuminate\Database\Eloquent\Collection $empleado__tipo__unidads
 */
class ServicioPuesto extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Servicio_Puesto';

    protected $primaryKey = 'ID_Servicio_Puesto';

    public $timestamps = false;

    protected $casts = [
        'Puesto_ID_Puesto' => 'int',
        'Servicio_ID_Servicio' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Puesto_ID_Puesto',
        'Servicio_ID_Servicio',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function puesto()
    {
        return $this->belongsTo(\App\Models\Puesto::class, 'Puesto_ID_Puesto');
    }

    public function servicio()
    {
        return $this->belongsTo(\App\Models\Servicio::class, 'Servicio_ID_Servicio');
    }

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empl_SSN.Empleado_Servicio_Puesto', 'Servicio_Puesto', 'Empleado')
            ->withPivot('ID_Empleado_Servicio_Puesto', 'Estandar', 'Servicio', 'Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function empleado__tipo__unidads()
    {
        return $this->hasMany(\App\Models\EmpleadoTipoUnidad::class, 'ID_Servicio_Puesto');
    }
}
