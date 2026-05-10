<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Empleado
 *
 * @property int $ID_Empleado
 * @property string $RFC
 * @property string $Nombre
 * @property string $Apellido_Paterno
 * @property string $Apellido_Materno
 * @property int $Base
 * @property string $Clave_Presupuestal
 * @property int $Status
 * @property string $Sexo
 * @property \Carbon\Carbon $Fecha_Nacimiento
 * @property string $Lugar_Nacimiento
 * @property int $Estado_Civil
 * @property string $CURP
 * @property string $Correo_Electronico
 * @property string $Foto
 * @property int $USER_CREATED
 * @property int $USER_UPDATED
 * @property \Carbon\Carbon $CREATED_AT
 * @property \Carbon\Carbon $UPDATED_AT
 * @property \App\Models\Base $base
 * @property \App\Models\EstadoCivil $estado_civil
 * @property \App\Models\Status $status
 * @property \Illuminate\Database\Eloquent\Collection $domicilios
 * @property \Illuminate\Database\Eloquent\Collection $cursos
 * @property \Illuminate\Database\Eloquent\Collection $escolars
 * @property \Illuminate\Database\Eloquent\Collection $especialidad__medicas
 * @property \Illuminate\Database\Eloquent\Collection $puestos
 * @property \Illuminate\Database\Eloquent\Collection $servicios
 * @property \Illuminate\Database\Eloquent\Collection $servicio__puestos
 * @property \Illuminate\Database\Eloquent\Collection $turnos
 * @property \Illuminate\Database\Eloquent\Collection $unidads
 * @property \Illuminate\Database\Eloquent\Collection $telefonos
 * @property \Illuminate\Database\Eloquent\Collection $users
 */
class Empleado extends Model
{
    protected $table = 'Empleado';

    protected $primaryKey = 'ID_Empleado';

    public $timestamps = false;

    protected $casts = [
        'Base' => 'int',
        'Status' => 'int',
        'Estado_Civil' => 'int',
        'USER_CREATED' => 'int',
        'USER_UPDATED' => 'int',
    ];

    protected $dates = [
        'Fecha_Nacimiento',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    protected $fillable = [
        'RFC',
        'Nombre',
        'Apellido_Paterno',
        'Apellido_Materno',
        'Base',
        'Clave_Presupuestal',
        'Status',
        'Sexo',
        'Fecha_Nacimiento',
        'Lugar_Nacimiento',
        'Estado_Civil',
        'CURP',
        'Correo_Electronico',
        'Foto',
        'USER_CREATED',
        'USER_UPDATED',
        'CREATED_AT',
        'UPDATED_AT',
    ];

    public function base()
    {
        return $this->belongsTo(\App\Models\Base::class, 'Base');
    }

    public function estado_civil()
    {
        return $this->belongsTo(\App\Models\EstadoCivil::class, 'Estado_Civil');
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class, 'Status');
    }

    public function domicilios()
    {
        return $this->hasMany(\App\Models\Domicilio::class, 'Empleado');
    }

    public function cursos()
    {
        return $this->belongsToMany(\App\Models\Curso::class, 'Empleado_Curso', 'Empleado_ID_Empleado', 'Curso_ID_Curso')
            ->withPivot('ID_Empleado_Curso', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function escolars()
    {
        return $this->belongsToMany(\App\Models\Escolar::class, 'Empleado_Escolar', 'Empleado_ID_Empleado', 'Escolar_ID_Escolar')
            ->withPivot('ID_Empleado_Escolar', 'Institucion', 'Titulo', 'Cedula_Estatal', 'Cedula_Federal', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function especialidad__medicas()
    {
        return $this->belongsToMany(\App\Models\EspecialidadMedica::class, 'Empleado_Especialidad_Medica', 'Empleado_ID_Empleado', 'Especialidad_Medica_ID_Especialidad')
            ->withPivot('ID_Empleado_Especialidad_Medica', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function puestos()
    {
        return $this->belongsToMany(\App\Models\Puesto::class, 'Empleado_Servicio_Puesto', 'Empleado', 'Puesto')
            ->withPivot('ID_Empleado_Servicio_Puesto', 'Estandar', 'Servicio_Puesto', 'Servicio', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function servicios()
    {
        return $this->belongsToMany(\App\Models\Servicio::class, 'Empleado_Servicio_Puesto', 'Empleado', 'Servicio')
            ->withPivot('ID_Empleado_Servicio_Puesto', 'Estandar', 'Servicio_Puesto', 'Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function servicio__puestos()
    {
        return $this->belongsToMany(\App\Models\ServicioPuesto::class, 'Empleado_Servicio_Puesto', 'Empleado', 'Servicio_Puesto')
            ->withPivot('ID_Empleado_Servicio_Puesto', 'Estandar', 'Servicio', 'Puesto', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function turnos()
    {
        return $this->belongsToMany(\App\Models\Turno::class, 'Empleado_Turno', 'Empleado_ID_Empleado', 'Turno_ID_Turno')
            ->withPivot('ID_Empleado_Turno', 'Fecha_Inicio', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function unidad()
    {
        return $this->belongsToMany(\App\Models\Unidad::class, 'Empleado_Unidad', 'Empleado_ID_Empleado', 'Unidad_Fisica')
            ->withPivot('ID_Empleado_Unidad', 'Unidad_Adscripcion', 'Estado_Adscripcion', 'Numero_Oficio', 'USER_CREATED', 'USER_UPDATED', 'CREATED_AT', 'UPDATED_AT');
    }

    public function getUnidadAttribute()
    {
        return \App\Models\EmpleadoUnidad::where('Empleado_ID_Empleado', $this->ID_Empleado)->first()->Unidad_Fisica;
    }

    public function telefonos()
    {
        return $this->hasMany(\App\Models\Telefono::class, 'Empleado');
    }

    public function users()
    {
        return $this->hasMany(\App\Models\User::class, 'employee');
    }

    public function jurisdiccion()
    {
        $this->unidad->hasOneThrough(\App\Models\Jurisdiccion::class, \App\Models\EmpleadoUnidad::class);
    }

    public function getJurisdiccionAttribute()
    {
        $results = DB::select('CALL `Empl_SSN`.`select_jurisdiccion_empleado`(?)', [$this->ID_Empleado]);

        if (count($results) > 0) {
            return $results[0];
        } else {
            return null;
        }
    }

    protected $appends = ['jurisdiccion', 'unidad'];
}
