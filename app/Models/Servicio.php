<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Servicio
 *
 * @property int $ID_Servicio
 * @property string $Nombre
 * @property string $Tipo_Servicio
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 * @property \Illuminate\Database\Eloquent\Collection $puestos
 */
class Servicio extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Servicio';

    protected $primaryKey = 'ID_Servicio';

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
        'Tipo_Servicio',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empl_SSN.Empleado_Servicio_Puesto', 'Servicio', 'Empleado')
            ->withPivot('ID_Empleado_Servicio_Puesto', 'Estandar', 'Servicio_Puesto', 'Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function puestos()
    {
        return $this->belongsToMany(\App\Models\Puesto::class, 'Servicio_Puesto', 'Servicio_ID_Servicio', 'Puesto_ID_Puesto')
            ->withPivot('ID_Servicio_Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
