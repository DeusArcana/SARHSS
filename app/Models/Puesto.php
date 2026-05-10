<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Puesto
 *
 * @property int $ID_Puesto
 * @property string $Codigo
 * @property string $Nombre
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \Illuminate\Database\Eloquent\Collection $empleados
 * @property \Illuminate\Database\Eloquent\Collection $servicios
 * @property \Illuminate\Database\Eloquent\Collection $puesto__homologos
 * @property \Illuminate\Database\Eloquent\Collection $requisito__academicos
 * @property \Illuminate\Database\Eloquent\Collection $ramas
 */
class Puesto extends Model
{
    protected $connection = 'mysql2';

    protected $table = 'Puesto';

    protected $primaryKey = 'ID_Puesto';

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
        'Codigo',
        'Nombre',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function empleados()
    {
        return $this->belongsToMany(\App\Models\Empleado::class, 'Empl_SSN.Empleado_Servicio_Puesto', 'Puesto', 'Empleado')
            ->withPivot('ID_Empleado_Servicio_Puesto', 'Estandar', 'Servicio_Puesto', 'Servicio', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function servicios()
    {
        return $this->belongsToMany(\App\Models\Servicio::class, 'Servicio_Puesto', 'Puesto_ID_Puesto', 'Servicio_ID_Servicio')
            ->withPivot('ID_Servicio_Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function puesto__homologos()
    {
        return $this->hasMany(\App\Models\PuestoHomologo::class, 'Puesto');
    }

    public function requisito__academicos()
    {
        return $this->belongsToMany(\App\Models\RequisitoAcademico::class, 'Puesto_Requisito_Academico', 'Puesto', 'Requisito_Academico')
            ->withPivot('ID_Puesto_Requisito_Academico', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function ramas()
    {
        return $this->belongsToMany(\App\Models\Rama::class, 'Rama_Puesto', 'Puesto_ID_Puesto', 'Rama_ID_Rama')
            ->withPivot('ID_Rama_Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }
}
