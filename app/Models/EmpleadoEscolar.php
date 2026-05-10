<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoEscolar
 *
 * @property int $ID_Empleado_Escolar
 * @property int $Empleado_ID_Empleado
 * @property int $Escolar_ID_Escolar
 * @property string $Institucion
 * @property string $Titulo
 * @property string $Cedula_Estatal
 * @property string $Cedula_Federal
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Empleado $empleado
 * @property \App\Models\Escolar $escolar
 */
class EmpleadoEscolar extends Model
{
    protected $table = 'Empleado_Escolar';

    protected $primaryKey = 'ID_Empleado_Escolar';

    public $timestamps = false;

    protected $casts = [
        'Empleado_ID_Empleado' => 'int',
        'Escolar_ID_Escolar' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Empleado_ID_Empleado',
        'Escolar_ID_Escolar',
        'Institucion',
        'Titulo',
        'Cedula_Estatal',
        'Cedula_Federal',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado_ID_Empleado');
    }

    public function escolar()
    {
        return $this->belongsTo(\App\Models\Escolar::class, 'Escolar_ID_Escolar');
    }
}
