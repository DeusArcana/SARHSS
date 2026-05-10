<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoEspecialidadMedica
 *
 * @property int $ID_Empleado_Especialidad_Medica
 * @property int $Especialidad_Medica_ID_Especialidad
 * @property int $Empleado_ID_Empleado
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 * @property \App\Models\EspecialidadMedica $especialidad_medica
 */
class EmpleadoEspecialidadMedica extends Model
{
    protected $table = 'Empleado_Especialidad_Medica';

    protected $primaryKey = 'ID_Empleado_Especialidad_Medica';

    public $timestamps = false;

    protected $casts = [
        'Especialidad_Medica_ID_Especialidad' => 'int',
        'Empleado_ID_Empleado' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Especialidad_Medica_ID_Especialidad',
        'Empleado_ID_Empleado',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado_ID_Empleado');
    }

    public function especialidad_medica()
    {
        return $this->belongsTo(\App\Models\EspecialidadMedica::class, 'Especialidad_Medica_ID_Especialidad');
    }
}
