<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EspecialidadMedica
 *
 * @property int $ID_Especialidad
 * @property string $Titulo
 * @property string $Consejo
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 */
class EspecialidadMedica extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Especialidad_Medica';

    protected $primaryKey = 'ID_Especialidad';

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
        'Titulo',
        'Consejo',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empl_SSN.Empleado_Especialidad_Medica', 'Especialidad_Medica_ID_Especialidad', 'Empleado_ID_Empleado')
            ->withPivot('ID_Empleado_Especialidad_Medica', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
