<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmpleadoCurso
 *
 * @property int $ID_Empleado_Curso
 * @property int $Empleado_ID_Empleado
 * @property int $Curso_ID_Curso
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Curso $curso
 * @property \App\Models\Empleado $empleado
 */
class EmpleadoCurso extends Model
{
    protected $table = 'Empleado_Curso';

    protected $primaryKey = 'ID_Empleado_Curso';

    public $timestamps = false;

    protected $casts = [
        'Empleado_ID_Empleado' => 'int',
        'Curso_ID_Curso' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'Empleado_ID_Empleado',
        'Curso_ID_Curso',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function curso()
    {
        return $this->belongsTo(\App\Models\Curso::class, 'Curso_ID_Curso');
    }

    public function empleado()
    {
        return $this->belongsTo(\App\Models\Empleado::class, 'Empleado_ID_Empleado');
    }
}
